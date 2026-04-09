===source===
<?php ['name' => $name, 'age' => $age] = $person;
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
                          "start": 7,
                          "end": 13,
                          "start_line": 1,
                          "start_col": 7
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "name"
                        },
                        "span": {
                          "start": 17,
                          "end": 22,
                          "start_line": 1,
                          "start_col": 17
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 22,
                        "start_line": 1,
                        "start_col": 7
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "age"
                        },
                        "span": {
                          "start": 24,
                          "end": 29,
                          "start_line": 1,
                          "start_col": 24
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "age"
                        },
                        "span": {
                          "start": 33,
                          "end": 37,
                          "start_line": 1,
                          "start_col": 33
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 24,
                        "end": 37,
                        "start_line": 1,
                        "start_col": 24
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 38,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "person"
                },
                "span": {
                  "start": 41,
                  "end": 48,
                  "start_line": 1,
                  "start_col": 41
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 48,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 49,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49,
    "start_line": 1,
    "start_col": 0
  }
}
