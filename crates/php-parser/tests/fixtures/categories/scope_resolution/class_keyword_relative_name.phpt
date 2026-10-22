===source===
<?php
namespace\static::f();
$f = fn(): namespace\self => 1;
$g = function (namespace\parent $a): namespace\static {};
class A extends B {
    public namespace\self $a;
    function m(namespace\self $a): namespace\parent {
        return new namespace\static;
    }
}
trait T {
    function m(): namespace\parent {}
}
===errors <=7.4===
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
===errors >=8.5===
Type declaration 'static' must be unqualified
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'static' (T_STATIC), expecting identifier (T_STRING) in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Type declaration 'static' must be unqualified in Standard input code on line 4
===ast===
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
                      "static"
                    ],
                    "kind": "Relative",
                    "span": {
                      "start": 6,
                      "end": 22
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 22
                }
              },
              "method": {
                "kind": {
                  "Identifier": "f"
                },
                "span": {
                  "start": 24,
                  "end": 25
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 27
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "f"
                },
                "span": {
                  "start": 29,
                  "end": 31
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "self"
                          ],
                          "kind": "Relative",
                          "span": {
                            "start": 40,
                            "end": 54
                          }
                        }
                      },
                      "span": {
                        "start": 40,
                        "end": 54
                      }
                    },
                    "body": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 58,
                        "end": 59
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 34,
                  "end": 59
                }
              }
            }
          },
          "span": {
            "start": 29,
            "end": 59
          }
        }
      },
      "span": {
        "start": 29,
        "end": 60
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "g"
                },
                "span": {
                  "start": 61,
                  "end": 63
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 93,
                            "end": 95
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "parent"
                              ],
                              "kind": "Relative",
                              "span": {
                                "start": 76,
                                "end": 92
                              }
                            }
                          },
                          "span": {
                            "start": 76,
                            "end": 92
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 76,
                          "end": 95
                        }
                      }
                    ],
                    "use_vars": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "static"
                          ],
                          "kind": "Relative",
                          "span": {
                            "start": 98,
                            "end": 114
                          }
                        }
                      },
                      "span": {
                        "start": 98,
                        "end": 114
                      }
                    },
                    "body": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 66,
                  "end": 117
                }
              }
            }
          },
          "span": {
            "start": 61,
            "end": 117
          }
        }
      },
      "span": {
        "start": 61,
        "end": 118
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 125,
              "end": 126
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 135,
              "end": 136
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 165,
                      "end": 167
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "self"
                        ],
                        "kind": "Relative",
                        "span": {
                          "start": 150,
                          "end": 164
                        }
                      }
                    },
                    "span": {
                      "start": 150,
                      "end": 164
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 143,
                "end": 167
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 182,
                      "end": 183
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 199,
                          "end": 201
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "self"
                            ],
                            "kind": "Relative",
                            "span": {
                              "start": 184,
                              "end": 198
                            }
                          }
                        },
                        "span": {
                          "start": 184,
                          "end": 198
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 184,
                        "end": 201
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "parent"
                        ],
                        "kind": "Relative",
                        "span": {
                          "start": 204,
                          "end": 220
                        }
                      }
                    },
                    "span": {
                      "start": 204,
                      "end": 220
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "static"
                                    ],
                                    "kind": "Relative",
                                    "span": {
                                      "start": 242,
                                      "end": 258
                                    }
                                  }
                                },
                                "span": {
                                  "start": 242,
                                  "end": 258
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 238,
                            "end": 258
                          }
                        }
                      },
                      "span": {
                        "start": 231,
                        "end": 259
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 173,
                "end": 265
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 119,
        "end": 267
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 274,
              "end": 275
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 291,
                      "end": 292
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "parent"
                        ],
                        "kind": "Relative",
                        "span": {
                          "start": 296,
                          "end": 312
                        }
                      }
                    },
                    "span": {
                      "start": 296,
                      "end": 312
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 282,
                "end": 315
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 268,
        "end": 317
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 317
  }
}
