===source===
<?php

function foo(Type) {
    $foo;
}

function foo(Type1 $foo, Type2) {
    $bar;
}

function foo(...) {
    $baz;
}

function foo(&) {
    $qux;
}

function foo(Bar)

class Bar {
    function foo(Baz)
}

function(Foo);
===errors===
expected variable, found ')'
expected variable, found ')'
expected variable, found ')'
expected variable, found ')'
expected variable, found ')'
expected '{', found 'class'
expected variable, found ')'
expected ';', found '}'
expected variable, found ')'
expected '{', found ';'
expected '}', found end of file
expected ';' after expression
expected '}' to close the delimiter opened at byte 171
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')', expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ")", expecting variable in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 16,
              "end": 19
            }
          },
          "params": [
            {
              "name": null,
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Type"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 20,
                      "end": 24
                    }
                  }
                },
                "span": {
                  "start": 20,
                  "end": 24
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 20,
                "end": 24
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Variable": "foo"
                  },
                  "span": {
                    "start": 32,
                    "end": 36
                  }
                }
              },
              "span": {
                "start": 32,
                "end": 37
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 39
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 50,
              "end": 53
            }
          },
          "params": [
            {
              "name": {
                "name": "foo",
                "span": {
                  "start": 60,
                  "end": 64
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Type1"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 54,
                      "end": 59
                    }
                  }
                },
                "span": {
                  "start": 54,
                  "end": 59
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 54,
                "end": 64
              }
            },
            {
              "name": null,
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Type2"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 66,
                      "end": 71
                    }
                  }
                },
                "span": {
                  "start": 66,
                  "end": 71
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 66,
                "end": 71
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Variable": "bar"
                  },
                  "span": {
                    "start": 79,
                    "end": 83
                  }
                }
              },
              "span": {
                "start": 79,
                "end": 84
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 41,
        "end": 86
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 97,
              "end": 100
            }
          },
          "params": [
            {
              "name": null,
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": true,
              "attributes": [],
              "span": {
                "start": 101,
                "end": 104
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Variable": "baz"
                  },
                  "span": {
                    "start": 112,
                    "end": 116
                  }
                }
              },
              "span": {
                "start": 112,
                "end": 117
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 88,
        "end": 119
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 130,
              "end": 133
            }
          },
          "params": [
            {
              "name": null,
              "type_hint": null,
              "default": null,
              "by_ref": true,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 134,
                "end": 135
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Variable": "qux"
                  },
                  "span": {
                    "start": 143,
                    "end": 147
                  }
                }
              },
              "span": {
                "start": 143,
                "end": 148
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 121,
        "end": 150
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 161,
              "end": 164
            }
          },
          "params": [
            {
              "name": null,
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Bar"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 165,
                      "end": 168
                    }
                  }
                },
                "span": {
                  "start": 165,
                  "end": 168
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 165,
                "end": 168
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Class": {
                  "name": {
                    "name": "Bar",
                    "span": {
                      "start": 177,
                      "end": 180
                    }
                  },
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
                          "name": {
                            "name": "foo",
                            "span": {
                              "start": 196,
                              "end": 199
                            }
                          },
                          "by_ref": false,
                          "params": [
                            {
                              "name": null,
                              "type_hint": {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "Baz"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 200,
                                      "end": 203
                                    }
                                  }
                                },
                                "span": {
                                  "start": 200,
                                  "end": 203
                                }
                              },
                              "default": null,
                              "by_ref": false,
                              "variadic": false,
                              "attributes": [],
                              "span": {
                                "start": 200,
                                "end": 203
                              }
                            }
                          ],
                          "return_type": null,
                          "body": null,
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 187,
                        "end": 204
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 171,
                "end": 206
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Closure": {
                      "is_static": false,
                      "by_ref": false,
                      "params": [
                        {
                          "name": null,
                          "type_hint": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Foo"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 217,
                                  "end": 220
                                }
                              }
                            },
                            "span": {
                              "start": 217,
                              "end": 220
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 217,
                            "end": 220
                          }
                        }
                      ],
                      "use_vars": [],
                      "return_type": null,
                      "body": [
                        {
                          "kind": "Nop",
                          "span": {
                            "start": 221,
                            "end": 222
                          }
                        }
                      ],
                      "attributes": []
                    }
                  },
                  "span": {
                    "start": 208,
                    "end": 222
                  }
                }
              },
              "span": {
                "start": 208,
                "end": 222
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 152,
        "end": 222
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 222
  }
}
