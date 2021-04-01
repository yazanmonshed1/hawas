import React, { useEffect, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux';

import {
    BrowserRouter as Router,
    Switch,
    Route
} from "react-router-dom";
import { setBook, setChapters } from './actions';
import { routes } from './providers/routes';
import { get } from './providers/services';

// Container pages
import AddExercise from './screens/AddExercise/AddExercise';
import AddLesson from './screens/AddLesson/AddLesson';

// Exercises
import PuzzleIndex from './screens/AddExercise/Forms/Puzzle/PuzzleIndex';
import PaintImagesIndex from './screens/AddExercise/Forms/PaintImages/PaintImagesIndex';
import ShapeDrawingsIndex from './screens/AddExercise/Forms/ShapeDrawings/ShapeDrawingsIndex';
import MatchingWordsWithSentenceIndex from './screens/AddExercise/Forms/MatchingWordsWithSentence/MatchingWordsWithSentenceIndex';
import SuitableWordsIndex from './screens/AddExercise/Forms/SuitableWords/SuitableWordsIndex';
import MatchingWordsWithImagesIndex from './screens/AddExercise/Forms/MatchingWordsWithImages/MatchingWordsWithImagesIndex';
import MemoryGameIndex from './screens/AddExercise/Forms/MemoryGame/MemoryGameIndex';
import MultipleChoicesIndex from './screens/AddExercise/Forms/MultipleChoices/MultipleChoicesIndex';

// Lessons
import VideoIndex from './screens/AddLesson/Forms/Video/VideoIndex';
import StoryIndex from './screens/AddLesson/Forms/Story/StoryIndex';

import HomeIndex from './screens/Home/HomeIndex';
import WordWallExamIndex from './screens/AddLesson/Forms/WordWallExam/WordWallExamIndex';
import Chapters from './Chapters';
import Loader from 'react-loader-spinner';

function Main() {

    const dispatch = useDispatch()

    const [status, setStatus] = useState('loading')

    const book = useSelector(state => state.book)

    useEffect(() => {
        const options = {
            route: routes.digitalBook.show,
        }
        async function getDetails() {
            const response = await get(options)
            await response.json().then(json => {
                dispatch(setBook(json.data))
                dispatch(setChapters(json.data.chapters))
                setStatus('success')
            })
        }
        getDetails();
    }, [])

    return status == 'success' ? (
        <Router basename={`/nadsoft/admin/digital-books/${document.getElementById('book_id').value}`}>
            <Switch>

                {/* Container pages */}
                <Route path="/:chapter/add-exercise" component={AddExercise} />
                <Route path="/:chapter/add-lesson" component={AddLesson} />

                {/* Exercises */}
                <Route path="/:chapter/exercise/puzzle/:id/edit" component={PuzzleIndex} />
                <Route path="/:chapter/exercise/puzzle" component={PuzzleIndex} />
                <Route path="/:chapter/exercise/painting-images/:id/edit" component={PaintImagesIndex} />
                <Route path="/:chapter/exercise/painting-images" component={PaintImagesIndex} />
                <Route path="/:chapter/exercise/shape-drawings/:id/edit" component={ShapeDrawingsIndex} />
                <Route path="/:chapter/exercise/shape-drawings" component={ShapeDrawingsIndex} />
                <Route path="/:chapter/exercise/matching-words-to-sentences/:id/edit" component={MatchingWordsWithSentenceIndex} />
                <Route path="/:chapter/exercise/matching-words-to-sentences" component={MatchingWordsWithSentenceIndex} />
                <Route path="/:chapter/exercise/suitable-words/:id/edit" component={SuitableWordsIndex} />
                <Route path="/:chapter/exercise/suitable-words" component={SuitableWordsIndex} />
                <Route path="/:chapter/exercise/matching-words-with-images/:id/edit" component={MatchingWordsWithImagesIndex} />
                <Route path="/:chapter/exercise/matching-words-with-images" component={MatchingWordsWithImagesIndex} />
                <Route path="/:chapter/exercise/memory-game/:id/edit" component={MemoryGameIndex} />
                <Route path="/:chapter/exercise/memory-game" component={MemoryGameIndex} />
                <Route path="/:chapter/exercise/multiple-choices/:id/edit" component={MultipleChoicesIndex} />
                <Route path="/:chapter/exercise/multiple-choices" component={MultipleChoicesIndex} />
                <Route path="/:chapter/exercise/wordwall-exam/:id/edit" component={WordWallExamIndex} />
                <Route path="/:chapter/exercise/wordwall-exam" component={WordWallExamIndex} />

                {/* Lessons */}
                <Route path="/:chapter/lesson/video/:id/edit" component={VideoIndex} />
                <Route path="/:chapter/lesson/video" component={VideoIndex} />
                <Route path="/:chapter/lesson/story/:id/edit" component={StoryIndex} />
                <Route path="/:chapter/lesson/story" component={StoryIndex} />

                {/* Home */}
                <Route path="/:chapter/contents" component={HomeIndex} />
                <Route path="/" component={Chapters} />
            </Switch>
        </Router>
    ) : <Loader />
}

export default Main
