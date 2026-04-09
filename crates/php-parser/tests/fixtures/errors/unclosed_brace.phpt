===source===
<?php function foo() { $x = 1;
===errors===
unclosed ''}'' opened at 1:21
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 23,
                          "end": 25,
                          "start_line": 1,
                          "start_col": 23
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 28,
                          "end": 29,
                          "start_line": 1,
                          "start_col": 28
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 23,
                    "end": 29,
                    "start_line": 1,
                    "start_col": 23
                  }
                }
              },
              "span": {
                "start": 23,
                "end": 30,
                "start_line": 1,
                "start_col": 23
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 30,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30,
    "start_line": 1,
    "start_col": 0
  }
}
