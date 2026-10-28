===source===
<?php
enum E {
    #[A]
    /** case */
    case X;
    #[A]
    /** method */
    public function m() {}
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 11,
              "end": 12
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 49,
                      "end": 50
                    }
                  },
                  "value": null,
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** case */",
                    "span": {
                      "start": 28,
                      "end": 39
                    }
                  }
                }
              },
              "span": {
                "start": 44,
                "end": 51
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 99,
                      "end": 100
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** method */",
                    "span": {
                      "start": 65,
                      "end": 78
                    }
                  }
                }
              },
              "span": {
                "start": 83,
                "end": 105
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 107
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 107
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 11,
              "end": 12
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 49,
                      "end": 50
                    }
                  },
                  "value": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "A"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 21,
                          "end": 22
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 21,
                        "end": 22
                      }
                    }
                  ],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** case */",
                    "span": {
                      "start": 28,
                      "end": 39
                    }
                  }
                }
              },
              "span": {
                "start": 19,
                "end": 51
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 99,
                      "end": 100
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "A"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 58,
                          "end": 59
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 58,
                        "end": 59
                      }
                    }
                  ],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** method */",
                    "span": {
                      "start": 65,
                      "end": 78
                    }
                  }
                }
              },
              "span": {
                "start": 56,
                "end": 105
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 107
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 107
  }
}
