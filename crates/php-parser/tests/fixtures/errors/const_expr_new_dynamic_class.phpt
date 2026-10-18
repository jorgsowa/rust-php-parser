===source===
<?php
function a($a = new static) {}
function b($a = new $x) {}
function c($a = new class {}) {}
function d($a = new Foo(...$x)) {}
function e($a = new Foo($x)) {}
function f($a = new Foo(a: f())) {}
===errors===
"static" is not allowed in compile-time constants
Cannot use dynamic class name in constant expression
Cannot use anonymous class in constant expression
Argument unpacking in constant expressions is not supported
Constant expression contains invalid operations
Constant expression contains invalid operations
===php_error===
PHP Fatal error:  "static" is not allowed in compile-time constants in Standard input code on line 2
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
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 17,
                  "end": 19
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "static"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 26,
                            "end": 32
                          }
                        }
                      },
                      "span": {
                        "start": 26,
                        "end": 32
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 22,
                  "end": 32
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 32
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "b",
            "span": {
              "start": 46,
              "end": 47
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 48,
                  "end": 50
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 57,
                        "end": 59
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 53,
                  "end": 59
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 48,
                "end": 59
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 37,
        "end": 63
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "c",
            "span": {
              "start": 73,
              "end": 74
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 75,
                  "end": 77
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": false
                          },
                          "extends": null,
                          "implements": [],
                          "members": [],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 80,
                        "end": 92
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 80,
                  "end": 92
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 75,
                "end": 92
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 64,
        "end": 96
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "d",
            "span": {
              "start": 106,
              "end": 107
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 108,
                  "end": 110
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 117,
                            "end": 120
                          }
                        }
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
                            "Variable": "x"
                          },
                          "span": {
                            "start": 124,
                            "end": 126
                          }
                        },
                        "unpack": true,
                        "by_ref": false,
                        "span": {
                          "start": 121,
                          "end": 126
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 113,
                  "end": 127
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 108,
                "end": 127
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 97,
        "end": 131
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "e",
            "span": {
              "start": 141,
              "end": 142
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 143,
                  "end": 145
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 152,
                            "end": 155
                          }
                        }
                      },
                      "span": {
                        "start": 152,
                        "end": 155
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 156,
                            "end": 158
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 156,
                          "end": 158
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 148,
                  "end": 159
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 143,
                "end": 159
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 132,
        "end": 163
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 173,
              "end": 174
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 175,
                  "end": 177
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 184,
                            "end": 187
                          }
                        }
                      },
                      "span": {
                        "start": 184,
                        "end": 187
                      }
                    },
                    "args": [
                      {
                        "name": {
                          "parts": [
                            "a"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 188,
                            "end": 189
                          }
                        },
                        "value": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "f"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 191,
                                      "end": 192
                                    }
                                  }
                                },
                                "span": {
                                  "start": 191,
                                  "end": 192
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 191,
                            "end": 194
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 188,
                          "end": 194
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 180,
                  "end": 195
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 175,
                "end": 195
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 164,
        "end": 199
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 199
  }
}
