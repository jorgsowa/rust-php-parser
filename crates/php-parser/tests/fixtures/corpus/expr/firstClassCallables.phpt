===source===
<?php
foo(...);
$this->foo(...);
A::foo(...);

// `$this?->foo(...)` is rejected at compile time.
$this?->foo(...);

#[Foo(...)]
function foo() {}
===errors===
Cannot combine nullsafe operator with Closure creation
Cannot create Closure as attribute argument
===php_error===
PHP Fatal error:  Cannot create Closure as attribute argument in Standard input code on line 10
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
                    "Name": {
                      "parts": [
                        "foo"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 6,
                        "end": 9
                      }
                    }
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
                      "Name": {
                        "parts": [
                          "A"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 33,
                          "end": 34
                        }
                      }
                    },
                    "span": {
                      "start": 33,
                      "end": 34
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "foo"
                    },
                    "span": {
                      "start": 36,
                      "end": 39
                    }
                  }
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
            "CallableCreate": {
              "kind": {
                "NullsafeMethod": {
                  "object": {
                    "kind": {
                      "Variable": "this"
                    },
                    "span": {
                      "start": 98,
                      "end": 103
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "foo"
                    },
                    "span": {
                      "start": 106,
                      "end": 109
                    }
                  }
                }
              }
            }
          },
          "span": {
            "start": 98,
            "end": 114
          }
        }
      },
      "span": {
        "start": 98,
        "end": 115
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 138,
              "end": 141
            }
          },
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
                  "start": 119,
                  "end": 122
                }
              },
              "args": [],
              "span": {
                "start": 119,
                "end": 127
              }
            }
          ]
        }
      },
      "span": {
        "start": 129,
        "end": 146
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 146
  }
}
