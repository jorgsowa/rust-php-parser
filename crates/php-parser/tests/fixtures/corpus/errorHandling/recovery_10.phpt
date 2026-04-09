===source===
<?php
function foo() {
    $bar->
}
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
                    "PropertyAccess": {
                      "object": {
                        "kind": {
                          "Variable": "bar"
                        },
                        "span": {
                          "start": 27,
                          "end": 31,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      "property": {
                        "kind": "Error",
                        "span": {
                          "start": 34,
                          "end": 35,
                          "start_line": 4,
                          "start_col": 0
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 27,
                    "end": 35,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 27,
                "end": 34,
                "start_line": 3,
                "start_col": 4
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
        "end": 35,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35,
    "start_line": 1,
    "start_col": 0
  }
}
