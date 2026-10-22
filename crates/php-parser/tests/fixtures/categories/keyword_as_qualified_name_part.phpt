===source===
<?php
class\Foo::x();
function\bar();
new list\Item;
namespace\Foo::X;
===errors <=7.4===
expected class name, found '\'
expected '{', found '\'
expected class member, found '::'
expected method name, found '\'
expected '(', found '\'
expected variable, found '('
expected ')', found '('
expected ';', found '('
expected 'function' or 'const', found '('
expected identifier, found ')'
expected '&', found ')'
expected class member, found ';'
expected class member, found 'new'
expected 'function' or 'const', found 'namespace'
expected class member, found '::'
expected '}', found end of file
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '\' (T_NS_SEPARATOR), expecting identifier (T_STRING) in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": null,
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": null,
                  "by_ref": false,
                  "params": [
                    {
                      "name": null,
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "bar"
                            ],
                            "kind": "FullyQualified",
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
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 30,
                        "end": 34
                      }
                    }
                  ],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 34
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 70
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "class",
                      "Foo"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 6,
                      "end": 15
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 15
                }
              },
              "method": {
                "kind": {
                  "Identifier": "x"
                },
                "span": {
                  "start": 17,
                  "end": 18
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
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
                      "function",
                      "bar"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 22,
                      "end": 34
                    }
                  }
                },
                "span": {
                  "start": 22,
                  "end": 34
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 22,
            "end": 36
          }
        }
      },
      "span": {
        "start": 22,
        "end": 37
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
                      "list",
                      "Item"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 42,
                      "end": 51
                    }
                  }
                },
                "span": {
                  "start": 42,
                  "end": 51
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 38,
            "end": 51
          }
        }
      },
      "span": {
        "start": 38,
        "end": 52
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "Foo"
                    ],
                    "kind": "Relative",
                    "span": {
                      "start": 53,
                      "end": 66
                    }
                  }
                },
                "span": {
                  "start": 53,
                  "end": 66
                }
              },
              "member": {
                "kind": {
                  "Identifier": "X"
                },
                "span": {
                  "start": 68,
                  "end": 69
                }
              }
            }
          },
          "span": {
            "start": 53,
            "end": 69
          }
        }
      },
      "span": {
        "start": 53,
        "end": 70
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70
  }
}
