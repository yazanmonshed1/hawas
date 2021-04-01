import React from 'react'
import { Form } from 'react-bootstrap'
import { labels } from '../assets/translations/labels'

const options = [
    { id: 1, title: 'الفصل الاول' },
    { id: 2, title: 'الفصل الثاني' },
    { id: 3, title: 'الفصل الثالث' },
    { id: 4, title: 'الفصل الرابع' },
]

function ChapterField({ value, onChange }) {
    return (
        <Form.Group>
            <Form.Label>{labels.chapter}</Form.Label>
            <select className="form-control" defaultValue={value} onChange={e => onChange(e.target.value)} name="chapter_id">
                {options.map(option => <option value={option.id} key={option.id}>{option.title}</option>)}
            </select>
        </Form.Group>
    )
}

export default ChapterField
