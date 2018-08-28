import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class Results extends Component
{
    constructor(props)
    {
        super(props);
        console.log(props.data)
        this.state = {
            customers: JSON.parse(props.data)
        }
        this.invite = this.invite.bind(this);
    }

    invite(int)
    {
        let clone_customer = this.state.customers;
        clone_customer[int]['invite_sent'] = true;

        this.setState({
            customers: clone_customer
        });
    }

    render() {
        return (
           <div>
           { this.state.customers.map(function(key, customer) {
                <p>Blah</p>
           }) }
           </div>
       )
            
    }
}

export default Results;
if (document.getElementById('app')) {
    console.log(document.getElementById('app'))
    var data = document.getElementById('xyz').innerHTML;
   ReactDOM.render(<Results data={data}/>, document.getElementById('app'));
}