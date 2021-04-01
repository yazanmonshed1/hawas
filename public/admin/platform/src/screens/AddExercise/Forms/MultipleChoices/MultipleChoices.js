import React, { useState, useEffect } from 'react'
import { Accordion, Button, Card, Col, Form, Row } from 'react-bootstrap'
import { labels } from '../../../../assets/translations/labels'

function MultipleChoices({ props }) {

    const [title, setTitle] = useState(null)

    const [items, setItems] = useState([])

    useEffect(() => {
        if (props.mode == 'edit') {
            setTitle(props.data.title)
            setItems(props.data.contents)
        }
    }, [])

    const handleSubmit = () => {
        const data = {
            title: title,
            multiple_choices: items
        }
        props.handleSubmit(data)
    }

    const handleSentenceChange = (value, id) => {
        setItems(
            items.map(item =>
                item.id === id
                    ? { ...item, question: value }
                    : item
            )
        )
    }

    const removeItem = (id) => {
        setItems(items.filter(item => item.id !== id))
    }

    const handleChoiceChange = (value, id, choiceId) => {
        let currentChoices = items.filter(item => item.id == id)[0].choices
        let newChoices = currentChoices.map(item => item.id == choiceId ? { ...item, choice: value } : item)
        setItems(
            items.map(item =>
                item.id === id
                    ? { ...item, choices: newChoices }
                    : item
            )
        )
    }

    const addChoice = (id) => {
        setItems(
            items.map(item =>
                item.id === id
                    ? { ...item, choices: [...item.choices, { id: Date.now(), choice: '', is_correct: false }] }
                    : item
            )
        )
    }

    const removeChoice = (id, choiceId) => {
        let currentChoices = items.filter(item => item.id == id)[0].choices
        let newChoices = currentChoices.filter(item => item.id != choiceId)
        setItems(
            items.map(item =>
                item.id === id
                    ? { ...item, choices: newChoices }
                    : item
            )
        )
    }

    const setCorrcectChoice = (id, choiceId) => {
        let currentChoices = items.filter(item => item.id == id)[0].choices
        let newChoices = []
        currentChoices.map(item => {
            let obj;
            if (item.id == choiceId) {
                obj = { ...item, is_correct: !item.is_correct }
            } else {
                obj = { ...item }
            }
            newChoices.push(obj)
        })
        setItems(
            items.map(item =>
                item.id === id
                    ? { ...item, choices: newChoices }
                    : item
            )
        )
    }

    const renderChoice = (choice, id) => {
        return (
            <Row className="align-items-end" key={choice.id}>
                <Form.Group>
                    <Form.Label>{labels.text}</Form.Label>
                    <Form.Control onChange={e => handleChoiceChange(e.target.value, id, choice.id)} value={choice.choice} />
                </Form.Group>
                <Form.Group className="px-2 cursor-pointer" onClick={() => removeChoice(id, choice.id)}>
                    <i className="fa fa-trash fa-2x text-danger"></i>
                </Form.Group>
                <Form.Group className="px-2 cursor-pointer" onClick={() => setCorrcectChoice(id, choice.id)}>
                    <i className={`fa fa-check fa-2x ${choice.is_correct && 'text-success'}`}></i>
                </Form.Group>
            </Row>
        )
    }

    const renderItem = item => {
        return (
            <Accordion key={item.id} className="border p-3">
                <Card>
                    <Accordion.Toggle as={Card.Header} eventKey={item.id}>
                        {item.question ? item.question : labels.click_to_add_question}
                    </Accordion.Toggle>
                    <Accordion.Collapse eventKey={item.id}>
                        <Card.Body>
                            <Row>
                                <Col md="6">
                                    <Form.Group>
                                        <Form.Label>{labels.sentence}</Form.Label>
                                        <Form.Control onChange={e => handleSentenceChange(e.target.value, item.id)} value={item.question} />
                                    </Form.Group>
                                </Col>
                                <Col md="6">
                                    <a className="text-primary cursor-pointer" onClick={() => addChoice(item.id)}>
                                        <i className="fa fa-plus"></i>
                                        <span className="px-2">{labels.add_choices}</span>
                                    </a>
                                    {item.choices.map((choice, idx) => renderChoice(choice, item.id))}
                                </Col>
                            </Row>
                            <div className="d-inline-block cursor-pointer p-3" onClick={() => removeItem(item.id)}>
                                <i className="fa fa-trash fa-2x text-danger"></i>
                            </div>
                        </Card.Body>
                    </Accordion.Collapse>
                </Card>
            </Accordion>
        )
    }

    return (
        <>
            <Form.Group>
                <Form.Label>{labels.title}</Form.Label>
                <Form.Control defaultValue={title} onChange={e => setTitle(e.target.value)} />
            </Form.Group>
            {items.map(item => renderItem(item))}
            <a className="text-primary cursor-pointer" onClick={() => setItems([...items, { id: Date.now(), question: '', choices: [] }])}>
                <i className="fa fa-plus"></i>
                <span className="px-2">{labels.add_question}</span>
            </a>
            <Form.Group>
                <Button onClick={() => handleSubmit()}>{labels.save}</Button>
            </Form.Group>

        </>
    )
}

export default MultipleChoices

