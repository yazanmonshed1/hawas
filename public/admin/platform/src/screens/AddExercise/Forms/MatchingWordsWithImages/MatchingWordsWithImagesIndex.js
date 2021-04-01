import React, { Component } from 'react'
import { connect } from 'react-redux'
import { setErrors, showToastr } from '../../../../actions'
import { labels } from '../../../../assets/translations/labels'
import Layout from '../../../../layouts/Layout'
import { routes } from '../../../../providers/routes'
import { get, post } from '../../../../providers/services'
import MatchingWordsWithImages from './MatchingWordsWithImages'

export class MatchingWordsWithImagesIndex extends Component {

    constructor(props) {
        super(props)
        this.state = {
            data: null,
            status: 'success',
            mode: 'create'
        }
    }

    componentDidMount() {
        if (this.props.match.params.id) {
            this.setState({
                status: 'loading',
                mode: 'edit'
            })
            this.getData()
        }
    }

    async getData() {
        const options = {
            route: `${routes.getContent}/${this.props.match.params.id}`
        }

        const response = await get(options)
        await response.json().then(json => {
            this.setState({
                data: json.data,
                status: 'success'
            })
        })
    }

    handleResponse(response, json) {
        switch (response.status) {
            case 201:
                this.props.setErrors(null)
                this.props.showToastr(false)
                this.props.history.push(`/${this.props.match.params.chapter}/contents`)
                break;
            case 422:
                this.props.showToastr(true)
                this.props.setErrors(json.errors)
                break;
        }
    }

    async handleSubmit(data) {

        let route = this.state.mode == 'create' ? `${routes.matchWordsToImages.create}/${this.props.match.params.chapter}` : `${routes.matchWordsToImages.edit}/${this.state.data.book_content_id}`

        const options = {
            route: route,
            body: data
        }

        const response = await post(options)

        await response.json().then(json => this.handleResponse(response, json))
    }

    renderTemplate() {
        const status = this.state.status
        switch (status) {
            case 'success':
                return <MatchingWordsWithImages props={{
                    handleSubmit: data => this.handleSubmit(data),
                    data: this.state.data,
                    mode: this.state.mode,
                }} />
        }
    }

    render() {
        return (
            <Layout title={labels.matching_words_to_images}>{this.renderTemplate()}</Layout>
        )
    }
}

const mapDispatchToProps = dispatch => {
    return {
        setErrors: (errors) => dispatch(setErrors(errors)),
        showToastr: (show) => dispatch(showToastr(show)),
    }
}

export default connect(null, mapDispatchToProps)(MatchingWordsWithImagesIndex)
