export default {
    get(type, id, offset = 0, cb) {
        let url;
        switch (type) {
            case 'posts':
                url = '/api/posts/' + id + '/comments'
                break;

            case 'comments':
                url = '/api/comments/' + id + '/comments'
                break
        }


        axios
            .get(url, {
                params: {
                    offset: offset
                }
            })
            .then((response) => {
                let data = new Object;
                data.comments = response.data.comments;
                data.commentsCount = response.data.count;
                return data;
            })
            .then(data => {
                cb(data)
            })
            .catch(error => {
                console.log(error);
            })
    },

    save(content, type, postId, parent_id, cb) {
        let url;

        switch (type) {
            case 'posts':
                url = '/api/posts/' + postId + '/comments'
                break;

            case 'comments':
                url = '/api/comments/' + postId + '/comments'
                break
        }

        axios
            .post(url, {
                content: content,
                parent_id: parent_id,
                _token: document.querySelector('meta[name=csrf-token]').getAttribute('content')

            })
            .then(response => {
                let data = new Object();
                data.comment = response.data.comment;
                data.commentsCount = response.data.commentsCount;
                return data;
            })
            .then(data => {
                cb(data)
            })
            .catch(error => {
                console.log(error)
            })
    }
}
