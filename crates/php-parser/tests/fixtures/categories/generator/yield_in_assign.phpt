===source===
<?php function gen() { $val = yield 'key' => 'value'; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "gen",
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "val"
                        },
                        "span": {
                          "start": 23,
                          "end": 27,
                          "start_line": 1,
                          "start_col": 23
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Yield": {
                            "key": {
                              "kind": {
                                "String": "key"
                              },
                              "span": {
                                "start": 36,
                                "end": 41,
                                "start_line": 1,
                                "start_col": 36
                              }
                            },
                            "value": {
                              "kind": {
                                "String": "value"
                              },
                              "span": {
                                "start": 45,
                                "end": 52,
                                "start_line": 1,
                                "start_col": 45
                              }
                            },
                            "is_from": false
                          }
                        },
                        "span": {
                          "start": 30,
                          "end": 52,
                          "start_line": 1,
                          "start_col": 30
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 23,
                    "end": 52,
                    "start_line": 1,
                    "start_col": 23
                  }
                }
              },
              "span": {
                "start": 23,
                "end": 54,
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
        "end": 55,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55,
    "start_line": 1,
    "start_col": 0
  }
}
