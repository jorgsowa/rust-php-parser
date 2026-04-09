===source===
<?php
list('name' => $name, 'age' => $age) = $person;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "name"
                        },
                        "span": {
                          "start": 11,
                          "end": 17,
                          "start_line": 2,
                          "start_col": 5
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "name"
                        },
                        "span": {
                          "start": 21,
                          "end": 26,
                          "start_line": 2,
                          "start_col": 15
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 11,
                        "end": 26,
                        "start_line": 2,
                        "start_col": 5
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "age"
                        },
                        "span": {
                          "start": 28,
                          "end": 33,
                          "start_line": 2,
                          "start_col": 22
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "age"
                        },
                        "span": {
                          "start": 37,
                          "end": 41,
                          "start_line": 2,
                          "start_col": 31
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 28,
                        "end": 41,
                        "start_line": 2,
                        "start_col": 22
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 42,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "person"
                },
                "span": {
                  "start": 45,
                  "end": 52,
                  "start_line": 2,
                  "start_col": 39
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 52,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 53,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53,
    "start_line": 1,
    "start_col": 0
  }
}
