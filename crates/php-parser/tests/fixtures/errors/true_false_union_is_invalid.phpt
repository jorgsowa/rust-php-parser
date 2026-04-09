===source===
<?php function f(): true|false {}
===errors===
Type contains both true and false, bool must be used instead
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f",
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "true"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 24,
                        "start_line": 1,
                        "start_col": 20
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 24,
                    "start_line": 1,
                    "start_col": 20
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "false"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 25,
                        "end": 30,
                        "start_line": 1,
                        "start_col": 25
                      }
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 30,
                    "start_line": 1,
                    "start_col": 25
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 30,
              "start_line": 1,
              "start_col": 20
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 33,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33,
    "start_line": 1,
    "start_col": 0
  }
}
