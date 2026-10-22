===source===
<?php $r = $value |> fn($s) => trim($s);
===errors <=8.4===
'pipe operator (|>)' requires PHP 8.5 or higher
arrow function on the right side of pipe operator must be parenthesized
===errors >=8.5===
arrow function on the right side of pipe operator must be parenthesized
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '>' in Standard input code on line 1
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token ">" in Standard input code on line 1
===php_error >=8.5===
PHP Fatal error:  Arrow functions on the right hand side of |> must be parenthesized in Standard input code on line 1
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
                              "name": {
                                "name": "s",
                                "span": {
                                  "start": 24,
                                  "end": 26
                                }
                              },
                              "type_hint": null,
                              "default": null,
                              "by_ref": false,
                              "variadic": false,
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
                                    "Name": {
                                      "parts": [
                                        "trim"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 31,
                                        "end": 35
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 31,
                                    "end": 35
                                  }
                                },
                                "args": [
                                  {
                                    "name": null,
                                    "kind": {
                                      "Value": {
                                        "kind": {
                                          "Variable": "s"
                                        },
                                        "span": {
                                          "start": 36,
                                          "end": 38
                                        }
                                      }
                                    },
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
