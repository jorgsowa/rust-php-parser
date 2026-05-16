===source===
<?php
foo(...);
$this->foo(...);
A::foo(...);

// `$this?->foo(...)` is rejected at runtime by PHP but accepted at parse level.
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
                      "start": 128,
                      "end": 133
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "foo"
                    },
                    "span": {
                      "start": 136,
                      "end": 139
                    }
                  }
                }
              }
            }
          },
          "span": {
            "start": 128,
            "end": 144
          }
        }
      },
      "span": {
        "start": 128,
        "end": 145
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
                  "start": 149,
                  "end": 152
                }
              },
              "args": [],
              "span": {
                "start": 149,
                "end": 157
              }
            }
          ]
        }
      },
      "span": {
        "start": 159,
        "end": 176
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 176
  }
}
===php_error===
PHP Fatal error:  Cannot create Closure as attribute argument in Standard input code on line 10
