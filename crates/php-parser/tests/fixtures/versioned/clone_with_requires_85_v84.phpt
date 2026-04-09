===config===
parse_version=8.4
===source===
<?php $b = clone($a, ['alpha' => 128]);
===errors===
'clone with property overrides' requires PHP 8.5 or higher (targeting PHP 8.4)
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
                  "Variable": "b"
                },
                "span": {
                  "start": 6,
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CloneWith": [
                    {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 17,
                        "end": 19,
                        "start_line": 1,
                        "start_col": 17
                      }
                    },
                    {
                      "kind": {
                        "Array": [
                          {
                            "key": {
                              "kind": {
                                "String": "alpha"
                              },
                              "span": {
                                "start": 22,
                                "end": 29,
                                "start_line": 1,
                                "start_col": 22
                              }
                            },
                            "value": {
                              "kind": {
                                "Int": 128
                              },
                              "span": {
                                "start": 33,
                                "end": 36,
                                "start_line": 1,
                                "start_col": 33
                              }
                            },
                            "unpack": false,
                            "span": {
                              "start": 22,
                              "end": 36,
                              "start_line": 1,
                              "start_col": 22
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 21,
                        "end": 37,
                        "start_line": 1,
                        "start_col": 21
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 38,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 38,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 39,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39,
    "start_line": 1,
    "start_col": 0
  }
}
