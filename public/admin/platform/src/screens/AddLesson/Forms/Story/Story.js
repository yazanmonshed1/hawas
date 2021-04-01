import React, { useState, useEffect } from 'react'
import RichTextEditor from '../../../../components/RichTextEditor'
import { Form, Button } from 'react-bootstrap'
import { labels } from '../../../../assets/translations/labels'
import Loader from 'react-loader-spinner'
import FileUploader from '../../../../components/FileUploader'

function Story({ props }) {

    const [textValue, setTextValue] = useState('')

    const [status, setStatus] = useState('success')

    const [title, setTitle] = useState('')

    const [questionsEnabled, setQuestionsEnabled] = useState(false)

    const [multipleChoicesId, setMultipleChoicesId] = useState('select')

    const [allChoices, setAllChoices] = useState([])

    const [isLoading, setIsLoading] = useState(false)

    const [audio, setAudio] = useState(null)
    const [video, setVideo] = useState(null)

    useEffect(() => {
        function init() {
            if (props.mode == 'edit') {
                setTitle(props.data.title)
                setAudio(props.data.contents.audio)
                setVideo(props.data.contents.video)
                setTextValue(props.data.contents.description)
                if (props.data.contents.multiple_choices_id) {
                    setMultipleChoicesId(props.data.contents.multiple_choices_id)
                    setQuestionsEnabled(true)
                }
            }
        }
        init()
    }, [])

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

    useEffect(() => {
        if (questionsEnabled && allChoices.length === 0) {
            setIsLoading(true)
            getChoices()
        }
    }, [questionsEnabled])

    const handleSubmit = () => {
        let data = {
            title: title,
            description: textValue,
            audio: audio,
            video: video
        }
        if (questionsEnabled && multipleChoicesId && multipleChoicesId != 'select') {
            data.multiple_choices_id = multipleChoicesId
        }
        props.handleSubmit(data)
    }

    return status == 'success' ? (
        <>
            <Form.Group>
                <Form.Label>{labels.title}</Form.Label>
                <Form.Control value={title} onChange={e => setTitle(e.target.value)} />
            </Form.Group>
            <Form.Group>
                <Form.Label>{labels.audio}</Form.Label>
                <FileUploader setFilePath={setAudio} initFile={audio} label={labels.upload_audio} type="audio"></FileUploader>
            </Form.Group>
            <Form.Group>
                <Form.Label>{labels.video}</Form.Label>
                <FileUploader setFilePath={setVideo} initFile={video} label={labels.upload_video} type="video"></FileUploader>
            </Form.Group>
            <RichTextEditor value={textValue} onChange={data => setTextValue(data)} />
            <Form.Group>
                <Form.Check checked={questionsEnabled} onChange={e => setQuestionsEnabled(e.target.checked)} type="checkbox" label={labels.with_questions} />
            </Form.Group>
            {isLoading && <Loader />}
            {!isLoading && questionsEnabled && <Form.Control as="select" onChange={e => setMultipleChoicesId(e.target.value)}>
                <option value="null">{labels.choose}</option>
                {allChoices.map(item => <option selected={multipleChoicesId == item.id} value={item.id} key={item.id}>{item.title}</option>)}
            </Form.Control>}
            <Form.Group>
                <Button onClick={() => handleSubmit()}>{labels.save}</Button>
            </Form.Group>
        </>
    ) : <Loader />
}

export default Story
