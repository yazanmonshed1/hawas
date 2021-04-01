import React, { useState, useEffect } from 'react'
import FileUploader from '../../../../components/FileUploader'
import { Form, Button } from 'react-bootstrap'
import { labels } from '../../../../assets/translations/labels'
import Loader from 'react-loader-spinner'

function Video({ props }) {

    const [title, setTitle] = useState('')

    const [video, setVideo] = useState(null)

    const [questionsEnabled, setQuestionsEnabled] = useState(false)

    const [multipleChoicesId, setMultipleChoicesId] = useState('select')

    const [allChoices, setAllChoices] = useState([])

    const [isLoading, setIsLoading] = useState(false)

    useEffect(() => {
        function init() {
            if (props.mode == 'edit') {
                setTitle(props.data.title)
                setVideo(props.data.contents.video)
                if (props.data.contents.multiple_choices_id) {
                    setMultipleChoicesId(props.data.contents.multiple_choices_id)
                    setQuestionsEnabled(true)
                }
            }
        }
        init()
    }, [])

    useEffect(() => {
        async function getChoices() {
            const response = await props.getMultipleChoices()
            await response.json().then(json => {
                setAllChoices(json.data)
                setIsLoading(false)
                if (props.mode != 'edit') {
                    setMultipleChoicesId(json.data[0].id)
                }
            })
        }
        if (questionsEnabled && allChoices.length === 0) {
            setIsLoading(true)
            getChoices()
        }
    }, [questionsEnabled])

    const handleSubmit = () => {
        let data = {
            title: title,
            video: video,
        }
        if (questionsEnabled && multipleChoicesId && multipleChoicesId != 'select') {
            data.multiple_choices_id = multipleChoicesId
        }
        props.handleSubmit(data)
    }

    return (
        <>
            <Form.Group>
                <Form.Label>{labels.title}</Form.Label>
                <Form.Control value={title} onChange={e => setTitle(e.target.value)} />
            </Form.Group>
            <Form.Group>
                <FileUploader initFile={video} type='video' setFilePath={path => setVideo(path)} label={labels.upload_video} />
            </Form.Group>
            <Form.Group>
                <Form.Check checked={questionsEnabled} onChange={e => setQuestionsEnabled(e.target.checked)} type="checkbox" label={labels.with_questions} />
            </Form.Group>
            {isLoading && <Loader />}
            {!isLoading && questionsEnabled && <Form.Control value={multipleChoicesId} as="select" onChange={e => setMultipleChoicesId(e.target.value)}>
                {allChoices.map(item => <option value={item.id} key={item.id}>{item.title}</option>)}
            </Form.Control>}
            <Form.Group>
                <Button onClick={() => handleSubmit()}>{labels.save}</Button>
            </Form.Group>
        </>
    )
}

export default Video
