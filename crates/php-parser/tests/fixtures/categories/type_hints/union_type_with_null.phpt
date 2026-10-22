===source===
<?php function foo(int|string|null $x): string|false { return ''; }
===errors <=7.4===
'union types' requires PHP 8.0 or higher
'null type' requires PHP 8.0 or higher
'union types' requires PHP 8.0 or higher
'false type' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting variable (T_VARIABLE) in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 15,
              "end": 18
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 35,
                  "end": 37
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 19,
                            "end": 22
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 22
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 23,
                            "end": 29
                          }
                        }
                      },
                      "span": {
                        "start": 23,
                        "end": 29
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "null"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 30,
                            "end": 34
                          }
                        }
                      },
                      "span": {
                        "start": 30,
                        "end": 34
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 34
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 19,
                "end": 37
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "String": ""
                  },
                  "span": {
                    "start": 62,
                    "end": 64
                  }
                }
              },
              "span": {
                "start": 55,
                "end": 65
              }
            }
          ],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "string"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 40,
                        "end": 46
                      }
                    }
                  },
                  "span": {
                    "start": 40,
                    "end": 46
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "false"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 47,
                        "end": 52
                      }
                    }
                  },
                  "span": {
                    "start": 47,
                    "end": 52
                  }
                }
              ]
            },
            "span": {
              "start": 40,
              "end": 52
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}
