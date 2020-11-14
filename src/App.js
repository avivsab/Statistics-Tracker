import './App.css';
import { Statistics } from './components/Statistics'
import { Button, LinearProgress } from '@material-ui/core';
function App() {
  return (
    <div className="App">
      <div style={{width: '75%', margin: 'auto'}}>
      <Statistics />
    </div>
    </div>
  );
}

export default App;
