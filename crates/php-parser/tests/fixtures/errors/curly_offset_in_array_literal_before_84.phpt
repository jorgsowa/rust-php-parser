===source===
<?php
$x = [$a{0}->b];
===errors >=8.2===
Array and string offset access syntax with curly braces is no longer supported
===php_error 8.2-8.3===
PHP Fatal error:  Array and string offset access syntax with curly braces is no longer supported in Standard input code on line 2
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected token "{", expecting "]" in Standard input code on line 2
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 12,
                                        "end": 14
                                      }
                                    },
                                    "index": {
                                      "kind": {
                                        "Int": 0
                                      },
                                      "span": {
                                        "start": 15,
                                        "end": 16
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 12,
                                  "end": 17
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "b"
                                },
                                "span": {
                                  "start": 19,
                                  "end": 20
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 12,
                            "end": 20
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 20
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 21
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
