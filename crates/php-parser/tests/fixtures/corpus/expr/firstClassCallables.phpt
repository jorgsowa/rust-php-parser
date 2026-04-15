===source===
<?php
foo(...);
$this->foo(...);
A::foo(...);

// These are invalid, but accepted on the parser level.
new Foo(...);
$this?->foo(...);

#[Foo(...)]
function foo() {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "CallableCreate": {
              "kind": {
                "Function": {
                  "kind": {
                    "Identifier": "foo"
                  },
                  "span": {
                    "start": 6,
                    "end": 9
                  }
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "CallableCreate": {
              "kind": {
                "Method": {
                  "object": {
                    "kind": {
                      "Variable": "this"
                    },
                    "span": {
                      "start": 16,
                      "end": 21
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "foo"
                    },
                    "span": {
                      "start": 23,
                      "end": 26
                    }
                  }
                }
              }
            }
          },
          "span": {
            "start": 16,
            "end": 31
          }
        }
      },
      "span": {
        "start": 16,
        "end": 32
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "CallableCreate": {
              "kind": {
                "StaticMethod": {
                  "class": {
                    "kind": {
                      "Identifier": "A"
                    },
                    "span": {
                      "start": 33,
                      "end": 34
                    }
                  },
                  "method": "foo"
                }
              }
            }
          },
          "span": {
            "start": 33,
            "end": 44
          }
        }
      },
      "span": {
        "start": 33,
        "end": 45
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 107,
                  "end": 110
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 103,
            "end": 115
          }
        }
      },
      "span": {
        "start": 103,
        "end": 116
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "CallableCreate": {
              "kind": {
                "NullsafeMethod": {
                  "object": {
                    "kind": {
                      "Variable": "this"
                    },
                    "span": {
                      "start": 117,
                      "end": 122
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "foo"
                    },
                    "span": {
                      "start": 125,
                      "end": 128
                    }
                  }
                }
              }
            }
          },
          "span": {
            "start": 117,
            "end": 133
          }
        }
      },
      "span": {
        "start": 117,
        "end": 134
      }
    },
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Foo"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 138,
                  "end": 141
                }
              },
              "args": [],
              "span": {
                "start": 138,
                "end": 146
              }
            }
          ]
        }
      },
      "span": {
        "start": 148,
        "end": 165
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 165
  }
}
===php_error===
PHP Fatal error:  Cannot create Closure for new expression in Standard input code on line 7
Stack trace:
#0 {main}
