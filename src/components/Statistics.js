import React, { useEffect, useState } from "react";
import { makeStyles } from "@material-ui/core/styles";
import Table from "@material-ui/core/Table";
import TableBody from "@material-ui/core/TableBody";
import TableCell from "@material-ui/core/TableCell";
import TableContainer from "@material-ui/core/TableContainer";
import TableHead from "@material-ui/core/TableHead";
import TableRow from "@material-ui/core/TableRow";
import Paper from "@material-ui/core/Paper";
import Typography from "@material-ui/core/Typography";
import FormControlLabel from "@material-ui/core/FormControlLabel";
import Switch from "@material-ui/core/Switch";

const useStyles = makeStyles({
  table: {
    minWidth: 650
  }
});

export function Statistics() {
  const [rows, setrows] = useState([]);
  const classes = useStyles();
  const [state, setState] = React.useState({
    sort: false
  });

  const handleChange = event => {
    setState({ ...state, [event.target.name]: event.target.checked });
    if (!state.sort) {
      rows.sort((a, b) => {
        return a.clicks - b.clicks;
      });
      setrows(rows);
    } else {
      rows.sort((a, b) => {
        return a.id - b.id;
      });
      setrows(rows);
    }
  };

  useEffect(() => {
    fetch("http://localhost:8200/")
      .then(res => res.json())
      .then(data => setrows(data))
      .catch(err => console.error(err));
  }, []);
  return (
    <div>
      <Typography variant="h2" gutterBottom>
        Web Statistics
      </Typography>
      <FormControlLabel
        control={
          <Switch checked={state.sort} onChange={handleChange} name="sort" />
        }
        label="Sort BY Clicks"
      />
      <hr />
      <TableContainer component={Paper}>
        <Table className={classes.table} aria-label="simple table">
          <TableHead>
            <TableRow>
              <TableCell>Serial</TableCell>
              <TableCell align="right">Elements</TableCell>
              <TableCell align="right">Clicks</TableCell>
              <TableCell align="right">Time</TableCell>
              <TableCell align="right">Date</TableCell>
            </TableRow>
          </TableHead>
          <TableBody>
            {rows.map(row => (
              <TableRow key={row.id}>
                <TableCell component="th" scope="row">
                  {row.id}
                </TableCell>
                <TableCell align="right">{row.elementId}</TableCell>
                <TableCell align="right">{row.clicks}</TableCell>
                <TableCell align="right">
                  {new Date(row.created_at).toLocaleTimeString()}
                </TableCell>
                <TableCell align="right">
                  {new Date(row.created_at).toLocaleDateString()}
                </TableCell>
              </TableRow>
            ))}
          </TableBody>
        </Table>
      </TableContainer>
    </div>
  );
}

export default Statistics;
