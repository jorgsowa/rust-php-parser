===source===
<?php const X;
===errors===
expected '=', found ';'
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": "X",
            "value": {
              "kind": "Error",
              "span": {
                "start": 13,
                "end": 14,
                "start_line": 1,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 14,
              "start_line": 1,
              "start_col": 12
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 14,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14,
    "start_line": 1,
    "start_col": 0
  }
}
