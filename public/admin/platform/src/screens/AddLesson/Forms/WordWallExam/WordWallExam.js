import React, { useState, useEffect } from 'react'
import { Form, Button } from 'react-bootstrap'
import { labels } from '../../../../assets/translations/labels'

function WordWallExam({ props }) {

    const [title, setTitle] = useState('')
    const [embed, setEmbed] = useState('')

    useEffect(() => {
        if (props.mode == 'edit') {
            setTitle(props.data.title)
            setEmbed(props.data.contents.embed)
        }
    }, [])

    const handleSubmit = () => {
        let data = {
            title: title,
            embed: embed,
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
                <Form.Label>{labels.embed}</Form.Label>
                <Form.Control value={embed} onChange={e => setEmbed(e.target.value)} />
            </Form.Group>
            <Form.Group>
                <Button onClick={() => handleSubmit()}>{labels.save}</Button>
            </Form.Group>
        </>
    )
}

export default WordWallExam
