/**
 * Created by kpicaza on 1/08/16.
 */
import React from 'react';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import Avatar from 'material-ui/Avatar';
import List from 'material-ui/List/List';
import ListItem from 'material-ui/List/ListItem';
import {
    deepOrange300,
    purple500,
} from 'material-ui/styles/colors';

var BaseApp = React.createClass({
    render: function () {
        let style = {margin: 5};

        let myAvatar = () => (
            <Avatar
                color={deepOrange300}
                backgroundColor={purple500}
                size={30}
                style={style}
            >
                A
            </Avatar>
        );

        return (
            <MuiThemeProvider>
                <List>
                    <ListItem
                        disabled={true}
                        leftAvatar={myAvatar()}
                    >
                    </ListItem>
                </List>

            </MuiThemeProvider>
        );
    }
});

module.exports = BaseApp;
