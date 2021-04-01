import React, { useState, useEffect } from 'react'
import { Button, Col, Form, Row } from 'react-bootstrap'
import { labels } from '../../../../assets/translations/labels'
import FileUploader from '../../../../components/FileUploader'
import TitleField from '../../../../components/TitleField'

function MatchingWordsWithImages({ props }) {

    const [items, setItems] = useState([])

    const [title, setTitle] = useState(null)

    useEffect(() => {
        if (props.mode == 'edit') {
            setTitle(props.data.title)
            setItems(props.data.contents)
        }
    }, [])

    const handleSubmit = () => {
        const data = {
            title: title,
            images_items: items
        }
        props.handleSubmit(data)
    }

    const handleTextChange = (value, id) => {
        setItems(
            items.map(item =>
                item.id === id
                    ? { ...item, title: value }
                    : item
            )
        )
    }

    const handleFileChange = (value, id) => {
        setItems(
            items.map(item =>
                item.id === id
                    ? { ...item, image: value }
                    : item
            )
        )
    }

    const removeItem = id => setItems(items.filter(item => item.id !== id))

    const renderFileUploader = item => {
        return <Col md="3" key={item.id} className="border p-3 bg-white mb-3">
            <Form.Group className="">
                <Form.Label>{labels.word}</Form.Label>
                <Form.Control value={item.title} onChange={e => handleTextChange(e.target.value, item.id)} />
            </Form.Group>
            <Form.Group>
                <Form.Label>{labels.image}</Form.Label>
                <FileUploader setFilePath={(filePath) => handleFileChange(filePath, item.id)} initFile={item.image ? item.image : null} />
            </Form.Group>
            <Form.Group>
                <Button className="btn-danger w-100" onClick={() => removeItem(item.id)}>
                    <i className="fa fa-trash"></i>
                </Button>
            </Form.Group>
        </Col>
    }

    return (
        <>
            <TitleField value={title} onChange={setTitle} />
            <Row>
                {items.map(item => renderFileUploader(item))}
            </Row>
            <a className="title-primary cursor-pointer mb-3" onClick={() => setItems([...items, { id: 'new-' + Date.now(), title: '', image: null }])}>
                <i className="fa fa-plus"></i>
                <span className="px-2">{labels.add}</span>
            </a>
            <Form.Group>
                <Button onClick={() => handleSubmit()}>{labels.save}</Button>
            </Form.Group>
        </>
    )
}

export default MatchingWordsWithImages
