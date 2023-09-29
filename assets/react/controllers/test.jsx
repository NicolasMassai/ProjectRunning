import React, { Component } from 'react';

class test extends Component {
  constructor(props) {
    super(props);
    this.state = {
      tasks: [],
      newTask: '',
    };
  }

  handleInputChange = (event) => {
    this.setState({ newTask: event.target.value });
  };

  addTask = () => {
    if (this.state.newTask.trim() === '') return;
    const updatedTasks = [...this.state.tasks, this.state.newTask];
    this.setState({ tasks: updatedTasks, newTask: '' });
  };

  deleteTask = (index) => {
    const updatedTasks = [...this.state.tasks];
    updatedTasks.splice(index, 1);
    this.setState({ tasks: updatedTasks });
  };

  render() {
    return (
      <div>
        <h1>Ma liste de tâches</h1>
        <div>
          <input
            type="text"
            placeholder="Ajouter une nouvelle tâche"
            value={this.state.newTask}
            onChange={this.handleInputChange}
          />
          <button onClick={this.addTask}>Ajouter</button>
        </div>
        <ul>
          {this.state.tasks.map((task, index) => (
            <li key={index}>
              {task}
              <button onClick={() => this.deleteTask(index)}>Supprimer</button>
            </li>
          ))}
        </ul>
      </div>
    );
  }
}

export default test;
