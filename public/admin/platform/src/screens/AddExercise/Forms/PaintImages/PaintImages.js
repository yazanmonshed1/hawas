import React, { useState, useEffect } from 'react'
import { Button, Form, Row } from 'react-bootstrap'
import FileUploader from '../../../../components/FileUploader'
import ColorPicker, { useColor } from "react-color-palette";
import Popup from 'reactjs-popup';
import 'reactjs-popup/dist/index.css';
import { labels } from '../../../../assets/translations/labels';

function PaintImages({ props }) {

    const [filePath, setFilePath] = useState(null)

    const [isOpen, setIsOpen] = useState(false)

    const [currentColor, setCurrentColor] = useColor("hex", "#121212");

    const [colors, setColors] = useState([])

    const [title, setTitle] = useState(null)

    useEffect(() => {
        if (props.mode == 'edit') {
            setTitle(props.data.title)
            setFilePath(props.data.contents.image)
            setColors(props.data.colors)
        }
    }, [])
    
    const handleColorAdd = () => {
        setIsOpen(false)
        setColors([...colors, currentColor.hex])
    }

    const handleColorRemove = (color) => {
        setIsOpen(false)
        setColors(colors.filter(item => item !== color));
    }

    const handleSubmit = () => {
        const data = {
            image: filePath,
            title: title,
            colors: colors
        }
        props.handleSubmit(data)
    }

    const renderColor = (color, idx) => <div className="d-flex flex-column align-items-center m-3">
        <div className="color-item" style={{ backgroundColor: color }} key={idx}></div>
        <i className="fa fa-trash fa-2x mt-2 text-danger" onClick={() => handleColorRemove(color)}></i>
    </div>
    return (
        <>
            <Form.Group>
                <Form.Label>{labels.title}</Form.Label>
                <Form.Control defaultValue={title} onChange={e => setTitle(e.target.value)} name="title" type="text" />
            </Form.Group>
            <Form.Group>
                <Form.Label>{labels.image}</Form.Label>
                <FileUploader initFile={filePath} setFilePath={path => setFilePath(path)} name="image" />
            </Form.Group>
            <Row>
                {colors.map((color, idx) => renderColor(color, idx))}
            </Row>
            <a className="d-block cursor-pointer text-primary my-3" onClick={() => setIsOpen(true)}>
                <i className="fa fa-paint-brush"></i>
                <span className="px-2">{labels.add_color}</span>
            </a>
            <Form.Group>
                <Button onClick={() => handleSubmit()}>{labels.save}</Button>
            </Form.Group>
            <Popup onClose={() => setIsOpen(false)} open={isOpen} modal >
                <div className="text-center">
                    <ColorPicker width={456} height={228} color={currentColor} onChange={setCurrentColor} hideHEX hideRGB hideHSB />
                    <Button onClick={() => handleColorAdd()}>{labels.add}</Button>
                </div>
            </Popup>
        </>
    )
}

export default PaintImages
