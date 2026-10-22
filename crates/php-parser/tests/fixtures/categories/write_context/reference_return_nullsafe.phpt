===source===
<?php
function &f($a) {
    $g = function ($a) { return $a?->b; };
    $h = fn($a) => $a?->b;
    yield $a?->b;
    yield 1 => $a?->b->c;
    return ($a?->b);
}
class C {
    public function &m($a) { return $a?->b(); }
    public $p { &get { return $this?->q; } }
}
$f = fn&($a) => $a?->b;
===errors <=7.4===
'nullsafe operator (?->)' requires PHP 8.0 or higher
'nullsafe operator (?->)' requires PHP 8.0 or higher
'nullsafe operator (?->)' requires PHP 8.0 or higher
Cannot take reference of a nullsafe chain
'nullsafe operator (?->)' requires PHP 8.0 or higher
Cannot take reference of a nullsafe chain
'nullsafe operator (?->)' requires PHP 8.0 or higher
Cannot take reference of a nullsafe chain
'nullsafe operator (?->)' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
'nullsafe operator (?->)' requires PHP 8.0 or higher
Cannot take reference of a nullsafe chain
'nullsafe operator (?->)' requires PHP 8.0 or higher
Cannot take reference of a nullsafe chain
===errors 8.0-8.3===
Cannot take reference of a nullsafe chain
Cannot take reference of a nullsafe chain
Cannot take reference of a nullsafe chain
'property hooks' requires PHP 8.4 or higher
Cannot take reference of a nullsafe chain
Cannot take reference of a nullsafe chain
===errors >=8.4===
Cannot take reference of a nullsafe chain
Cannot take reference of a nullsafe chain
Cannot take reference of a nullsafe chain
Cannot take reference of a nullsafe chain
Cannot take reference of a nullsafe chain
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR) in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 11
===php_error >=8.4===
PHP Fatal error:  Cannot take reference of a nullsafe chain in Standard input code on line 5
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 18,
                  "end": 20
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 18,
                "end": 20
              }
            }
          ],
          "body": [
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
                          "start": 28,
                          "end": 30
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
                                    "start": 43,
                                    "end": 45
                                  }
                                },
                                "type_hint": null,
                                "default": null,
                                "by_ref": false,
                                "variadic": false,
                                "attributes": [],
                                "span": {
                                  "start": 43,
                                  "end": 45
                                }
                              }
                            ],
                            "use_vars": [],
                            "return_type": null,
                            "body": [
                              {
                                "kind": {
                                  "Return": {
                                    "kind": {
                                      "NullsafePropertyAccess": {
                                        "object": {
                                          "kind": {
                                            "Variable": "a"
                                          },
                                          "span": {
                                            "start": 56,
                                            "end": 58
                                          }
                                        },
                                        "property": {
                                          "kind": {
                                            "Identifier": "b"
                                          },
                                          "span": {
                                            "start": 61,
                                            "end": 62
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 56,
                                      "end": 62
                                    }
                                  }
                                },
                                "span": {
                                  "start": 49,
                                  "end": 63
                                }
                              }
                            ],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 33,
                          "end": 65
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 65
                  }
                }
              },
              "span": {
                "start": 28,
                "end": 66
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "h"
                        },
                        "span": {
                          "start": 71,
                          "end": 73
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "ArrowFunction": {
                            "is_static": false,
                            "by_ref": false,
                            "params": [
                              {
                                "name": {
                                  "name": "a",
                                  "span": {
                                    "start": 79,
                                    "end": 81
                                  }
                                },
                                "type_hint": null,
                                "default": null,
                                "by_ref": false,
                                "variadic": false,
                                "attributes": [],
                                "span": {
                                  "start": 79,
                                  "end": 81
                                }
                              }
                            ],
                            "return_type": null,
                            "body": {
                              "kind": {
                                "NullsafePropertyAccess": {
                                  "object": {
                                    "kind": {
                                      "Variable": "a"
                                    },
                                    "span": {
                                      "start": 86,
                                      "end": 88
                                    }
                                  },
                                  "property": {
                                    "kind": {
                                      "Identifier": "b"
                                    },
                                    "span": {
                                      "start": 91,
                                      "end": 92
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 86,
                                "end": 92
                              }
                            },
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 76,
                          "end": 92
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 71,
                    "end": 92
                  }
                }
              },
              "span": {
                "start": 71,
                "end": 93
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "NullsafePropertyAccess": {
                            "object": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 104,
                                "end": 106
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "b"
                              },
                              "span": {
                                "start": 109,
                                "end": 110
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 104,
                          "end": 110
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 98,
                    "end": 110
                  }
                }
              },
              "span": {
                "start": 98,
                "end": 111
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 122,
                          "end": 123
                        }
                      },
                      "value": {
                        "kind": {
                          "PropertyAccess": {
                            "object": {
                              "kind": {
                                "NullsafePropertyAccess": {
                                  "object": {
                                    "kind": {
                                      "Variable": "a"
                                    },
                                    "span": {
                                      "start": 127,
                                      "end": 129
                                    }
                                  },
                                  "property": {
                                    "kind": {
                                      "Identifier": "b"
                                    },
                                    "span": {
                                      "start": 132,
                                      "end": 133
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 127,
                                "end": 133
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "c"
                              },
                              "span": {
                                "start": 135,
                                "end": 136
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 127,
                          "end": 136
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 116,
                    "end": 136
                  }
                }
              },
              "span": {
                "start": 116,
                "end": 137
              }
            },
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "NullsafePropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 150,
                              "end": 152
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 155,
                              "end": 156
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 150,
                        "end": 156
                      }
                    }
                  },
                  "span": {
                    "start": 149,
                    "end": 157
                  }
                }
              },
              "span": {
                "start": 142,
                "end": 158
              }
            }
          ],
          "return_type": null,
          "by_ref": true,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 160
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 167,
              "end": 168
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
                    "name": "m",
                    "span": {
                      "start": 192,
                      "end": 193
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": true,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 194,
                          "end": 196
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 194,
                        "end": 196
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "NullsafeMethodCall": {
                              "object": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 207,
                                  "end": 209
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "b"
                                },
                                "span": {
                                  "start": 212,
                                  "end": 213
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 207,
                            "end": 215
                          }
                        }
                      },
                      "span": {
                        "start": 200,
                        "end": 216
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 175,
                "end": 218
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 230,
                      "end": 232
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Return": {
                                "kind": {
                                  "NullsafePropertyAccess": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 249,
                                        "end": 254
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "q"
                                      },
                                      "span": {
                                        "start": 257,
                                        "end": 258
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 249,
                                  "end": 258
                                }
                              }
                            },
                            "span": {
                              "start": 242,
                              "end": 259
                            }
                          }
                        ]
                      },
                      "by_ref": true,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 235,
                        "end": 261
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 223,
                "end": 263
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 161,
        "end": 265
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
                  "start": 266,
                  "end": 268
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": true,
                    "params": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 275,
                            "end": 277
                          }
                        },
                        "type_hint": null,
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 275,
                          "end": 277
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "NullsafePropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 282,
                              "end": 284
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 287,
                              "end": 288
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 282,
                        "end": 288
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 271,
                  "end": 288
                }
              }
            }
          },
          "span": {
            "start": 266,
            "end": 288
          }
        }
      },
      "span": {
        "start": 266,
        "end": 289
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 289
  }
}
