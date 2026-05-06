===source===
<?php
// Edge case 1: Multiline function call
foo(
  1,
  2
);

// Edge case 2: Complex method chaining
$obj->foo()->bar(1)->baz();

// Edge case 3: Nullsafe in chain
$obj?->foo()?->bar();

// Edge case 4: Docblock with template
/** @template T */
class Foo {}

// Edge case 5: Function name with namespace
\Namespace\foo(1);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 46,
                  "end": 49
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 53,
                      "end": 54
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 53,
                    "end": 54
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 58,
                      "end": 59
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 58,
                    "end": 59
                  }
                }
              ]
            }
          },
          "span": {
            "start": 46,
            "end": 61
          }
        }
      },
      "span": {
        "start": 46,
        "end": 62
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "MethodCall": {
                          "object": {
                            "kind": {
                              "Variable": "obj"
                            },
                            "span": {
                              "start": 104,
                              "end": 108
                            }
                          },
                          "method": {
                            "kind": {
                              "Identifier": "foo"
                            },
                            "span": {
                              "start": 110,
                              "end": 113
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 104,
                        "end": 115
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "bar"
                      },
                      "span": {
                        "start": 117,
                        "end": 120
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 121,
                            "end": 122
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 121,
                          "end": 122
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 104,
                  "end": 123
                }
              },
              "method": {
                "kind": {
                  "Identifier": "baz"
                },
                "span": {
                  "start": 125,
                  "end": 128
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 104,
            "end": 130
          }
        }
      },
      "span": {
        "start": 104,
        "end": 131
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullsafeMethodCall": {
              "object": {
                "kind": {
                  "NullsafeMethodCall": {
                    "object": {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 167,
                        "end": 171
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "foo"
                      },
                      "span": {
                        "start": 174,
                        "end": 177
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 167,
                  "end": 179
                }
              },
              "method": {
                "kind": {
                  "Identifier": "bar"
                },
                "span": {
                  "start": 182,
                  "end": 185
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 167,
            "end": 187
          }
        }
      },
      "span": {
        "start": 167,
        "end": 188
      }
    },
    {
      "kind": {
        "Class": {
          "name": "Foo",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/** @template T */",
            "span": {
              "start": 229,
              "end": 247
            }
          }
        }
      },
      "span": {
        "start": 248,
        "end": 260
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "\\Namespace\\foo"
                },
                "span": {
                  "start": 307,
                  "end": 321
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 322,
                      "end": 323
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 322,
                    "end": 323
                  }
                }
              ]
            }
          },
          "span": {
            "start": 307,
            "end": 324
          }
        }
      },
      "span": {
        "start": 307,
        "end": 325
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 325
  }
}
