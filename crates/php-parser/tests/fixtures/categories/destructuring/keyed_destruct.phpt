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
                          "end": 13
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "name"
                          },
                          "span": {
                            "start": 17,
                            "end": 22
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 22
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "age"
                        },
                        "span": {
                          "start": 24,
                          "end": 29
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "age"
                          },
                          "span": {
                            "start": 33,
                            "end": 37
                          }
                        }
                      },
                      "span": {
                        "start": 24,
                        "end": 37
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 38
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "person"
                },
                "span": {
                  "start": 41,
                  "end": 48
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 48
          }
        }
      },
      "span": {
        "start": 6,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}
