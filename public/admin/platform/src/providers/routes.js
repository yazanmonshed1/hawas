const env = document.getElementById('env').value
export const baseUrl = env == 'production' ? 'http://hawas.nqa.nadsoft.co/' : 'http://hawas.local/';

const bookId = document.getElementById('book_id').value

export const routes = {
    uploadImage: 'digital-book/upload/image',
    uploadVideo: 'digital-book/upload/video',
    uploadAudio: 'digital-book/upload/audio',
    uploadImageCKEditor: 'digital-book/ckeditor/upload',
    digitalBookContentsReorder: `digital-book/contents-reorder`,
    digitalBookContents: `digital-book/${bookId}/contents`,
    getMultipleChoicesItems: `digital-book/${bookId}/multiple-choices-items`,
    deleteBookContent: 'digital-book/contents/delete',
    getContent: 'digital-book/content',
    chapters: `digital-book/${bookId}/chapters`,
    digitalBook: {
        show: `digital-book/${bookId}`
    },

    chapter: {
        create: `digital-book/${bookId}/add-chapter`,
        edit: `digital-book/chapter`,
        delete: `digital-book/chapter/delete`,
    },

    // Exercises
    puzzle: {
        create: `digital-book/exercise/${bookId}/puzzle/create`,
        edit: `digital-book/exercise/puzzle/edit`,
    },
    shapeDrawings: {
        create: `digital-book/exercise/${bookId}/shape-drawings/create`,
        edit: `digital-book/exercise/shape-drawings/edit`,
    },
    paintingImage: {
        create: `digital-book/exercise/${bookId}/painting-image/create`,
        edit: `digital-book/exercise/painting-image/edit`,
    },
    matchWordsToSentences: {
        create: `digital-book/exercise/${bookId}/match-words-to-sentences/create`,
        edit: `digital-book/exercise/match-words-to-sentences/edit`,
    },
    suitableWords: {
        create: `digital-book/exercise/${bookId}/suitable-words/create`,
        edit: `digital-book/exercise/suitable-words/edit`,
    },
    matchWordsToImages: {
        create: `digital-book/exercise/${bookId}/match-words-to-images/create`,
        edit: `digital-book/exercise/match-words-to-images/edit`,
    },
    memoryGame: {
        create: `digital-book/exercise/${bookId}/memory-game/create`,
        edit: `digital-book/exercise/memory-game/edit`,
    },
    multipleChoices: {
        create: `digital-book/exercise/${bookId}/multiple-choices/create`,
        edit: `digital-book/exercise/multiple-choices/edit`,
    },
    wordWallExam: {
        create: `digital-book/exercise/${bookId}/wordwall-exam/create`,
        edit: `digital-book/exercise/wordwall-exam/edit`,
    },

    // Lessons
    story: {
        create: `digital-book/lesson/${bookId}/story/create`,
        edit: `digital-book/lesson/story/edit`,
    },
    video: {
        create: `digital-book/lesson/${bookId}/video/create`,
        edit: `digital-book/lesson/video/edit`,
    },
}