import React from 'react'
import { Button, Col, Row } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import { DragDropContext, Droppable, Draggable } from "react-beautiful-dnd";
import { labels } from '../../assets/translations/labels';

const grid = 8;

const editable = ['videos', 'story']

const getItemStyle = (isDragging, draggableStyle) => ({
    userSelect: "none",
    padding: grid * 2,
    margin: `0 0 ${grid}px 0`,
    borderColor: isDragging ? "yellow" : "#1f3dd0",
    ...draggableStyle
});

const getListStyle = isDraggingOver => ({
    background: "white",
    padding: grid,
});

const reorder = (list, startIndex, endIndex) => {
    const result = Array.from(list);
    const [removed] = result.splice(startIndex, 1);
    result.splice(endIndex, 0, removed);

    return result;
};

class Home extends React.Component {

    constructor(props) {
        super(props)

        this.state = {
            items: [],
            multiple_choices: []
        }
        this.onDragEnd = this.onDragEnd.bind(this);
    }

    componentDidMount() {
        this.setState({
            items: this.props.data.contents,
            multiple_choices: this.props.data.multiple_choices,
        })
    }

    onDragEnd(result) {
        if (!result.destination) {
            return;
        }

        const items = reorder(
            this.state.items,
            result.source.index,
            result.destination.index
        );

        this.setState({ items: items })
        this.props.handleOrderChange(items)
    }

    deleteContent(id) {
        this.props.deleteContent(id)
    }

    editContent(item) {
        this.props.handleEditContent(item.table_name, item.id)
    }

    render() {
        return (
            <>
                <Row className="justify-content-center">
                    <Col md="4">
                        <Link to={`/${this.props.chapter}/add-exercise`} className="add-container d-flex flex-column justify-content-center align-items-center p-3 bg-white border mb-3">
                            <i className="fa fa-plus fa-3x mb-3"></i>
                            <h3>{labels.add_exercise}</h3>
                        </Link>
                    </Col>
                    <Col md="4">
                        <Link to={`/${this.props.chapter}/add-lesson`} className="add-container d-flex flex-column justify-content-center align-items-center p-3 bg-white border mb-3">
                            <i className="fa fa-plus fa-3x mb-3"></i>
                            <h3>{labels.add_lesson}</h3>
                        </Link>
                    </Col>
                </Row>
                <h4>{this.props.title}</h4>
                <DragDropContext onDragEnd={this.onDragEnd}>
                    <Droppable droppableId="droppable">
                        {(provided, snapshot) => (
                            <div
                                {...provided.droppableProps}
                                ref={provided.innerRef}
                                style={getListStyle(snapshot.isDraggingOver)}
                            >
                                {this.state.items.map((item, index) => (
                                    <Draggable key={item.id} draggableId={'page-' + item.id} index={index}>
                                        {(provided, snapshot) => (
                                            <div
                                                className="drag-item d-flex justify-content-between align-items-center"
                                                ref={provided.innerRef}
                                                key={item.id}
                                                {...provided.draggableProps}
                                                {...provided.dragHandleProps}
                                                style={getItemStyle(
                                                    snapshot.isDragging,
                                                    provided.draggableProps.style
                                                )}
                                            >
                                                <span>{item.page_number + ' - ' + item.title}</span>
                                                <div>
                                                    <Button className="btn-danger" onClick={() => this.deleteContent(item.id)}>
                                                        <i className="i fa fa-trash"></i>
                                                    </Button>
                                                    <Button className="btn-success mx-3" onClick={() => this.editContent(item)}>
                                                        <i className="i fa fa-edit"></i>
                                                    </Button>
                                                </div>
                                            </div>
                                        )}
                                    </Draggable>
                                ))}
                                {provided.placeholder}
                            </div>
                        )}
                    </Droppable>
                </DragDropContext>
                <hr className="my-3"></hr>
                <h4>{labels.multiple_choices}</h4>
                {this.state.multiple_choices.map(item => (
                    <div
                        className="drag-item d-flex justify-content-between align-items-center my-2 p-3"
                        key={item.id}
                    >
                        <span>{item.title}</span>
                        <div>
                            <Button className="btn-danger" onClick={() => this.deleteContent(item.id)}>
                                <i className="i fa fa-trash"></i>
                            </Button>
                            <Button className="btn-success mx-3" onClick={() => this.editContent(item)}>
                                <i className="i fa fa-edit"></i>
                            </Button>
                        </div>
                    </div>
                ))}
            </>
        )
    }
}

export default Home
