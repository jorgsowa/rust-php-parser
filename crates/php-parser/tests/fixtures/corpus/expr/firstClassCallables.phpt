===source===
<?php
foo(...);
$this->foo(...);
A::foo(...);

$this?->foo(...);

#[Foo(...)]
function foo() {}
===errors <=7.4===
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'nullsafe operator (?->)' requires PHP 8.0 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'attributes' requires PHP 8.0 or higher
===errors 8.0===
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callable syntax' requires PHP 8.1 or higher
Cannot create Closure as attribute argument
===errors >=8.1===
Cannot create Closure as attribute argument
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot create Closure as attribute argument in Standard input code on line 9
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
                      "start": 47,
                      "end": 52
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "foo"
                    },
                    "span": {
                      "start": 55,
                      "end": 58
                    }
                  }
                }
              }
            }
          },
          "span": {
            "start": 47,
            "end": 63
          }
        }
      },
      "span": {
        "start": 47,
        "end": 64
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 87,
              "end": 90
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
                  "start": 68,
                  "end": 71
                }
              },
              "args": [],
              "span": {
                "start": 68,
                "end": 76
              }
            }
          ]
        }
      },
      "span": {
        "start": 78,
        "end": 95
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 95
  }
}
