===config===
min_php=8.5
===source===
<?php $r = $value |> fn($s) => trim($s);
===errors===
arrow function on the right side of pipe operator must be parenthesized
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
                  "Variable": "r"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "value"
                      },
                      "span": {
                        "start": 11,
                        "end": 17
                      }
                    },
                    "op": "Pipe",
                    "right": {
                      "kind": {
                        "ArrowFunction": {
                          "is_static": false,
                          "by_ref": false,
                          "params": [
                            {
                              "name": "s",
                              "type_hint": null,
                              "default": null,
                              "by_ref": false,
                              "variadic": false,
                              "is_readonly": false,
                              "is_final": false,
                              "visibility": null,
                              "set_visibility": null,
                              "attributes": [],
                              "span": {
                                "start": 24,
                                "end": 26
                              }
                            }
                          ],
                          "return_type": null,
                          "body": {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "Identifier": "trim"
                                  },
                                  "span": {
                                    "start": 31,
                                    "end": 35
                                  }
                                },
                                "args": [
                                  {
                                    "name": null,
                                    "value": {
                                      "kind": {
                                        "Variable": "s"
                                      },
                                      "span": {
                                        "start": 36,
                                        "end": 38
                                      }
                                    },
                                    "unpack": false,
                                    "by_ref": false,
                                    "span": {
                                      "start": 36,
                                      "end": 38
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 31,
                              "end": 39
                            }
                          },
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 39
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 39
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 39
          }
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
===php_error===
PHP Fatal error:  Arrow functions on the right hand side of |> must be parenthesized in Standard input code on line 1
