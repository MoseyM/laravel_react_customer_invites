import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class Results extends Component
{
    constructor(props)
    {
        super(props);
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
        let headings = Object.keys(this.state.customers[0]);
        // let showInvite = customer['invite_sent'];
        let customerData = {};
        customerData = this.state.customers.forEach(
            function(customer) {
                let row=[];
                if (customer['invite_sent']) {
                    for(let i=0; i<headings.length;i++) {
                        row.push(<td>{customer[i]}</td>);
                    }
                } else {
                    for(let i=0; i<headings.indexOf['invite_sent'];i++) {
                        row.push(<td>{customer[i]}</td>);
                    }
                }
                return <tr>{row}</tr>;
            });

        return (
           <table>
                <tbody>
                    <tr>
                        {headings.map((key) => <th>{key.replace("_", " ")}</th>)}
                    </tr>
                    <tr>
                        {customerData}
                    </tr>
                </tbody>
           </table>
       )
            
    }
}

export default Results;
if (document.getElementById('app')) {
    var data = document.getElementById('xyz').innerHTML;
   ReactDOM.render(<Results data={data}/>, document.getElementById('app'));
}