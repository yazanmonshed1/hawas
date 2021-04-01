import React from 'react'
import { Form } from 'react-bootstrap'
import { labels } from '../assets/translations/labels'

function TitleField({value, onChange}) {
    return (
        <Form.Group>
            <Form.Label>{labels.title}</Form.Label>
            <Form.Control defaultValue={value} onChange={e => onChange(e.target.value)} name="title" />
        </Form.Group>
    )
}

export default TitleField
