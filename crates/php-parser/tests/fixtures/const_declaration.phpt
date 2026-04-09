===source===
<?php const PI = 3.14; const APP_NAME = 'MyApp';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": "PI",
            "value": {
              "kind": {
                "Float": 3.14
              },
              "span": {
                "start": 17,
                "end": 21,
                "start_line": 1,
                "start_col": 17
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 21,
              "start_line": 1,
              "start_col": 12
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 23,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "APP_NAME",
            "value": {
              "kind": {
                "String": "MyApp"
              },
              "span": {
                "start": 40,
                "end": 47,
                "start_line": 1,
                "start_col": 40
              }
            },
            "attributes": [],
            "span": {
              "start": 29,
              "end": 47,
              "start_line": 1,
              "start_col": 29
            }
          }
        ]
      },
      "span": {
        "start": 23,
        "end": 48,
        "start_line": 1,
        "start_col": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48,
    "start_line": 1,
    "start_col": 0
  }
}
