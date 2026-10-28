===source===
<?php
enum E {
    /** before */ #[A] /** after */ case X;
    case Y;
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
                    "name": "Y",
                    "span": {
                      "start": 68,
                      "end": 69
                    }
                  },
                  "value": null,
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** before */",
                    "span": {
                      "start": 19,
                      "end": 32
                    }
                  }
                }
              },
              "span": {
                "start": 63,
                "end": 70
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 72
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 72
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
                      "start": 56,
                      "end": 57
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
                          "start": 35,
                          "end": 36
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 35,
                        "end": 36
                      }
                    }
                  ],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** after */",
                    "span": {
                      "start": 38,
                      "end": 50
                    }
                  }
                }
              },
              "span": {
                "start": 33,
                "end": 58
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 68,
                      "end": 69
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 63,
                "end": 70
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 72
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 72
  }
}
