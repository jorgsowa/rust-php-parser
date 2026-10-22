===source===
<?php
function a(): int|void {}
function b(): int|never {}
function c(): int|mixed {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Void can only be used as a standalone type
'union types' requires PHP 8.0 or higher
'union types' requires PHP 8.0 or higher
'mixed type' requires PHP 8.0 or higher
Type mixed can only be used as a standalone type
===errors 8.0===
Void can only be used as a standalone type
Type mixed can only be used as a standalone type
===errors >=8.1===
Void can only be used as a standalone type
never can only be used as a standalone type
Type mixed can only be used as a standalone type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Void can only be used as a standalone type in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "a",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [],
          "return_type": {
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
                        "start": 20,
                        "end": 23
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 23
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "void"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 24,
                        "end": 28
                      }
                    }
                  },
                  "span": {
                    "start": 24,
                    "end": 28
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 28
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "b",
            "span": {
              "start": 41,
              "end": 42
            }
          },
          "params": [],
          "body": [],
          "return_type": {
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
                        "start": 46,
                        "end": 49
                      }
                    }
                  },
                  "span": {
                    "start": 46,
                    "end": 49
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "never"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 50,
                        "end": 55
                      }
                    }
                  },
                  "span": {
                    "start": 50,
                    "end": 55
                  }
                }
              ]
            },
            "span": {
              "start": 46,
              "end": 55
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 32,
        "end": 58
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "c",
            "span": {
              "start": 68,
              "end": 69
            }
          },
          "params": [],
          "body": [],
          "return_type": {
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
                        "start": 73,
                        "end": 76
                      }
                    }
                  },
                  "span": {
                    "start": 73,
                    "end": 76
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "mixed"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 77,
                        "end": 82
                      }
                    }
                  },
                  "span": {
                    "start": 77,
                    "end": 82
                  }
                }
              ]
            },
            "span": {
              "start": 73,
              "end": 82
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 59,
        "end": 85
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 85
  }
}
