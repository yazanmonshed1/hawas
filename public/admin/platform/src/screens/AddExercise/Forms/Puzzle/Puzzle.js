import React, { useEffect, useState } from 'react'
import { Button, Form, Row } from 'react-bootstrap'
import { labels } from '../../../../assets/translations/labels'
import FileUploader from '../../../../components/FileUploader'
import TitleField from '../../../../components/TitleField'

function Puzzle({ props }) {

    const [filePath, setFilePath] = useState(null)
    const [title, setTitle] = useState(null)
    const [parts, setParts] = useState([])

    useEffect(() => {
        if (props.mode == 'edit') {
            setTitle(props.data.title)
            setFilePath(props.data.contents.image)
            setParts(props.data.parts)
        }
    }, [])

    const handleSubmit = () => {
        const data = {
            image: filePath,
            title: title,
            parts: parts
        }
        props.handleSubmit(data)
    }

    const handlPartsChange = (number, idx, target) => {
        let currentParts = [...parts];
        currentParts[idx] = { ...currentParts[idx], [target]: number };
        setParts(currentParts);
    }

    const handleRemove = (number) => {
        setParts(parts.filter(item => item !== number));
    }

    const renderPuzzleItem = (item, idx) => {
        return <div className="mb-3" key={idx}>
            <Row>
                <Form.Group className="mb-0">
                    <Form.Label>{labels.rows_no}#</Form.Label>
                    <Form.Control type="number" value={item.x} onChange={e => handlPartsChange(e.target.value, idx, 'x')} />
                </Form.Group>
                <Form.Group className="mb-0">
                    <Form.Label>{labels.columns_no}#</Form.Label>
                    <Form.Control type="number" value={item.y} onChange={e => handlPartsChange(e.target.value, idx, 'y')} />
                </Form.Group>
                <i className="fa fa-trash fa-2x mx-3 text-danger cursor-pointer" onClick={() => handleRemove(item)}></i>
            </Row>
        </div>
    }

    return (
        <Form>
            <TitleField value={title} onChange={setTitle} />
            <Form.Group>
                <Form.Label>{labels.image}</Form.Label>
                <FileUploader initFile={filePath} setFilePath={path => setFilePath(path)} name="image" />
            </Form.Group>

            <Form.Label className="font-weight-bold">عدد القطع</Form.Label>
            <a className="text-primary pb-2 d-block cursor-pointer" onClick={() => setParts([...parts, 0])}>
                <i className="fa fa-plus"></i>
                <span className="px-2">{labels.add}</span>
            </a>
            {parts.map((item, idx) => renderPuzzleItem(item, idx))}
            <Form.Group>
                <Button onClick={() => handleSubmit(filePath)} disabled={filePath ? false : true}>{labels.save}</Button>
            </Form.Group>
        </Form>
    )
}

export default Puzzle
