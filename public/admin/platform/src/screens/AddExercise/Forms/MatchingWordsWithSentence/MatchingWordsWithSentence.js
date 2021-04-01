import React, { useEffect, useState } from 'react'
import { Button, Form, Row } from 'react-bootstrap'
import { labels } from '../../../../assets/translations/labels'

function MatchingWordsWithSentence({ props }) {

    const [title, setTitle] = useState(null)

    const [sentenceItems, setSentenceItems] = useState([])

    useEffect(() => {
        if (props.mode == 'edit') {
            setTitle(props.data.title)
            setSentenceItems(props.data.contents)
        }
    }, [])

    const handleSubmit = () => {
        const data = {
            title: title,
            sentences: sentenceItems
        }
        props.handleSubmit(data)
    }

    const handlItemChange = (value, id, property) => {
        setSentenceItems(
            sentenceItems.map(item =>
                item.id === id
                    ? { ...item, [property]: value }
                    : item
            ))
    }

    const handleRemove = (id) => {
        setSentenceItems(sentenceItems.filter(item => item.id !== id));
    }

    const renderSentenceItem = (sentence) => {
        return <div className="mb-3" key={sentence.id}>
            <Row className="align-items-end bg-white p-3 mb-3 border">
                <Form.Group className="mb-0">
                    <Form.Label>{labels.sentence}</Form.Label>
                    <Form.Control value={sentence.sentence} onChange={e => handlItemChange(e.target.value, sentence.id, 'sentence')} />
                </Form.Group>
                <Form.Group className="mb-0 mx-3">
                    <Form.Label>{labels.word}</Form.Label>
                    <Form.Control value={sentence.word} onChange={e => handlItemChange(e.target.value, sentence.id, 'word')} />
                </Form.Group>
                <Form.Group className="mb-0">
                    <i className="fa fa-trash fa-2x mx-3 text-danger cursor-pointer" onClick={() => handleRemove(sentence.id)}></i>
                </Form.Group>
            </Row>
        </div>
    }

    return (
        <Form>
            <Form.Group>
                <Form.Label>العنوان</Form.Label>
                <Form.Control defaultValue={title} onChange={e => setTitle(e.target.value)} name="title" type="text" />
            </Form.Group>
            <Form.Label className="font-weight-bold">{labels.content}</Form.Label>
            <a className="text-primary pb-2 d-block cursor-pointer" onClick={() => setSentenceItems([...sentenceItems, { id: 'new-' + Date.now(), word: '', sentence: '' }])}>
                <i className="fa fa-plus"></i>
                <span className="px-2">{labels.add}</span>
            </a>
            { sentenceItems.map((item) => renderSentenceItem(item))}
            <Form.Group>
                <Button onClick={() => handleSubmit()} >{labels.save}</Button>
            </Form.Group>
        </Form >
    )
}

export default MatchingWordsWithSentence
