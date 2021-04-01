import React, { useState, useEffect } from 'react'
import { Form, Row, Col, Button } from 'react-bootstrap'
import { labels } from '../../../../assets/translations/labels'
import FileUploader from '../../../../components/FileUploader'

function MemoryGame({ props }) {

    const [title, setTitle] = useState(null)

    const [items, setItems] = useState([])

    const removeItem = id => setItems(items.filter(item => item.id !== id))

    useEffect(() => {
        if (props.mode == 'edit') {
            setTitle(props.data.title)
            setItems(props.data.images)
        }
    }, [])

    const handleSubmit = () => {
        const data = {
            title: title,
            images: items
        }

        props.handleSubmit(data)
    }

    const handleFileChange = (value, id) => {
        setItems(
            items.map(item =>
                item.id === id
                    ? { ...item, uploadedFile: value }
                    : item
            )
        )
    }

    const renderFileUploader = item => {
        return <Col md="3" key={item.id} className="border p-3 bg-white mb-3">
            <Form.Group>
                <Form.Label>{labels.image}</Form.Label>
                <FileUploader initFile={item.uploadedFile} setFilePath={(filePath) => handleFileChange(filePath, item.id)} initFile={item.uploadedFile ? item.uploadedFile : null} />
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
            <Form.Group>
                <Form.Label>{labels.title}</Form.Label>
                <Form.Control defaultValue={title} onChange={e => setTitle(e.target.value)} />
            </Form.Group>
            <a className="text-primary cursor-pointer mb-3" onClick={() => setItems([...items, { id: Date.now(), uploadedFile: null }])}>
                <i className="fa fa-plus"></i>
                <span className="px-2">{labels.add}</span>
            </a>
            <Row>
                {items.map(item => renderFileUploader(item))}
            </Row>
            <Form.Group>
                <Button onClick={() => handleSubmit()}>{labels.save}</Button>
            </Form.Group>
        </>
    )
}

export default MemoryGame
