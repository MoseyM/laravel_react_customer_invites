import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Upload extends Component {
    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <form action="/upload" method="post" encType="multipart/form-data">
                            Input: <input type="file" name="data-file" id="data-file" />
                            <input type="submit" value="Submit" />
                        </form>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<Upload />, document.getElementById('app'));
}
