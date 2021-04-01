import React, { Component } from 'react'
import { connect } from 'react-redux'
import { Redirect } from 'react-router'
import Layout from '../../layouts/Layout'
import { routes } from '../../providers/routes'
import { get, post } from '../../providers/services'
import Home from './Home'

export class HomeIndex extends Component {

    constructor(props) {
        super(props)

        this.state = {
            data: [],
            status: 'loading'
        }
    }

    componentDidMount() {
        this.getData();
    }

    handleResponse(response, json) {
        switch (response.status) {
            case 200:
                this.setState({
                    data: json.data,
                    status: 'success'
                })
        }
    }

    handleEditContent(type, id) {
        switch (type) {
            case 'story':
                this.props.history.push(`/${this.props.match.params.chapter}/lesson/story/${id}/edit`)
                break
            case 'videos':
                this.props.history.push(`/${this.props.match.params.chapter}/lesson/video/${id}/edit`)
                break
            case 'puzzles':
                this.props.history.push(`/${this.props.match.params.chapter}/exercise/puzzle/${id}/edit`)
                break
            case 'drawing':
                this.props.history.push(`/${this.props.match.params.chapter}/exercise/shape-drawings/${id}/edit`)
                break
            case 'painting_images':
                this.props.history.push(`/${this.props.match.params.chapter}/exercise/painting-images/${id}/edit`)
                break
            case 'matching_words_to_sentences':
                this.props.history.push(`/${this.props.match.params.chapter}/exercise/matching-words-to-sentences/${id}/edit`)
                break
            case 'matching_words_to_images':
                this.props.history.push(`/${this.props.match.params.chapter}/exercise/matching-words-with-images/${id}/edit`)
                break
            case 'multiple_choices':
                this.props.history.push(`/${this.props.match.params.chapter}/exercise/multiple-choices/${id}/edit`)
                break
            case 'memory_game':
                this.props.history.push(`/${this.props.match.params.chapter}/exercise/memory-game/${id}/edit`)
                break
            case 'suitable_words':
                this.props.history.push(`/${this.props.match.params.chapter}/exercise/suitable-words/${id}/edit`)
                break
            case 'wordwall_exam':
                this.props.history.push(`/${this.props.match.params.chapter}/exercise/wordwall-exam/${id}/edit`)
                break

        }
    }

    async getData() {

        const options = {
            route: `${routes.digitalBookContents}/${this.props.match.params.chapter}`,
        }
        const response = await get(options)
        await response.json().then(json => this.handleResponse(response, json))
    }

    async handleOrderChange(data) {
        this.setState({ status: 'loading' })
        var orderedData = data.map(function (value, index, array) {
            return value.id;
        });

        const options = {
            route: routes.digitalBookContentsReorder,
            body: orderedData
        }

        const response = await post(options);
        await response.json().then(json => {
            if (response.status == 200) {
                this.getData()
            }
        })
    }

    async deleteContent(id) {
        this.setState({ status: 'loading' })

        const options = {
            route: routes.deleteBookContent,
            body: {
                content_id: id
            }
        }

        const response = await post(options);
        await response.json().then(json => {
            if (response.status == 200) {
                this.getData()
            }
        })
    }

    renderTemplate() {
        const status = this.state.status
        switch (status) {
            case 'success':
                const props = {
                    data: this.state.data,
                    chapter: this.props.match.params.chapter,
                    handleOrderChange: data => this.handleOrderChange(data),
                    deleteContent: data => this.deleteContent(data),
                    handleEditContent: (type, id) => this.handleEditContent(type, id),
                    title: this.props.title
                }
                return <Home {...props} />
        }
    }

    render() {
        return <Layout>{this.renderTemplate()}</Layout>
    }
}

const mapStateToProps = (state, props) => {
    return {
        title: state.book.chapters.filter(item => item.id === parseInt(props.match.params.chapter))[0].chapter,
    }
}

export default connect(mapStateToProps, null)(HomeIndex)
