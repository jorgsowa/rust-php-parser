===source===
<?php
Foo \ Bar \ Baz;
\ Foo();
namespace \ Foo();
new Foo\ Bar;
function f(): \ A {}
===errors===
A namespaced name cannot contain whitespace
A namespaced name cannot contain whitespace
A namespaced name cannot contain whitespace
A namespaced name cannot contain whitespace
A namespaced name cannot contain whitespace
===php_error===
PHP Parse error:  syntax error, unexpected token "\" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Name": {
              "parts": [
                "Foo",
                "Bar",
                "Baz"
              ],
              "kind": "Qualified",
              "span": {
                "start": 6,
                "end": 21
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
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "Foo"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 23,
                      "end": 28
                    }
                  }
                },
                "span": {
                  "start": 23,
                  "end": 28
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 23,
            "end": 30
          }
        }
      },
      "span": {
        "start": 23,
        "end": 31
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "Foo"
                    ],
                    "kind": "Relative",
                    "span": {
                      "start": 32,
                      "end": 47
                    }
                  }
                },
                "span": {
                  "start": 32,
                  "end": 47
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 32,
            "end": 49
          }
        }
      },
      "span": {
        "start": 32,
        "end": 50
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "Foo",
                      "Bar"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 55,
                      "end": 63
                    }
                  }
                },
                "span": {
                  "start": 55,
                  "end": 63
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 51,
            "end": 63
          }
        }
      },
      "span": {
        "start": 51,
        "end": 64
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 74,
              "end": 75
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "A"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 79,
                  "end": 82
                }
              }
            },
            "span": {
              "start": 79,
              "end": 82
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 65,
        "end": 85
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 85
  }
}
