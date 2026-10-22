===source===
<?php
const A = $f(...);
const B = (strlen)(...);
const C = f(...)(...);
const D = $x::m(...);
const E = static::m(...);
const F = Foo::$m(...);
const G = Foo::{PHP_EOL}(...);
===errors <=8.0===
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
===errors 8.1-8.4===
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
===errors >=8.5===
Cannot use dynamic function name in constant expression
Cannot use dynamic function name in constant expression
Cannot use dynamic function name in constant expression
Cannot use dynamic class name in constant expression
"static" is not allowed in compile-time constants
Cannot use dynamic method name in constant expression
Cannot use dynamic method name in constant expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 2
===php_error 8.1-8.4===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot use dynamic function name in constant expression in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "CallableCreate": {
                  "kind": {
                    "Function": {
                      "kind": {
                        "Variable": "f"
                      },
                      "span": {
                        "start": 16,
                        "end": 18
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 23
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 23
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 24
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 31,
                "end": 32
              }
            },
            "value": {
              "kind": {
                "CallableCreate": {
                  "kind": {
                    "Function": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "strlen"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 36,
                                "end": 42
                              }
                            }
                          },
                          "span": {
                            "start": 36,
                            "end": 42
                          }
                        }
                      },
                      "span": {
                        "start": 35,
                        "end": 43
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 35,
                "end": 48
              }
            },
            "attributes": [],
            "span": {
              "start": 31,
              "end": 48
            }
          }
        ]
      },
      "span": {
        "start": 25,
        "end": 49
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 56,
                "end": 57
              }
            },
            "value": {
              "kind": {
                "CallableCreate": {
                  "kind": {
                    "Function": {
                      "kind": {
                        "CallableCreate": {
                          "kind": {
                            "Function": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "f"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 60,
                                    "end": 61
                                  }
                                }
                              },
                              "span": {
                                "start": 60,
                                "end": 61
                              }
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 60,
                        "end": 66
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 60,
                "end": 71
              }
            },
            "attributes": [],
            "span": {
              "start": 56,
              "end": 71
            }
          }
        ]
      },
      "span": {
        "start": 50,
        "end": 72
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "D",
              "span": {
                "start": 79,
                "end": 80
              }
            },
            "value": {
              "kind": {
                "CallableCreate": {
                  "kind": {
                    "StaticMethod": {
                      "class": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 83,
                          "end": 85
                        }
                      },
                      "method": {
                        "kind": {
                          "Identifier": "m"
                        },
                        "span": {
                          "start": 87,
                          "end": 88
                        }
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 83,
                "end": 93
              }
            },
            "attributes": [],
            "span": {
              "start": 79,
              "end": 93
            }
          }
        ]
      },
      "span": {
        "start": 73,
        "end": 94
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "E",
              "span": {
                "start": 101,
                "end": 102
              }
            },
            "value": {
              "kind": {
                "CallableCreate": {
                  "kind": {
                    "StaticMethod": {
                      "class": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "static"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 105,
                              "end": 111
                            }
                          }
                        },
                        "span": {
                          "start": 105,
                          "end": 111
                        }
                      },
                      "method": {
                        "kind": {
                          "Identifier": "m"
                        },
                        "span": {
                          "start": 113,
                          "end": 114
                        }
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 105,
                "end": 119
              }
            },
            "attributes": [],
            "span": {
              "start": 101,
              "end": 119
            }
          }
        ]
      },
      "span": {
        "start": 95,
        "end": 120
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "F",
              "span": {
                "start": 127,
                "end": 128
              }
            },
            "value": {
              "kind": {
                "CallableCreate": {
                  "kind": {
                    "StaticMethod": {
                      "class": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "Foo"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 131,
                              "end": 134
                            }
                          }
                        },
                        "span": {
                          "start": 131,
                          "end": 134
                        }
                      },
                      "method": {
                        "kind": {
                          "Variable": "m"
                        },
                        "span": {
                          "start": 136,
                          "end": 138
                        }
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 131,
                "end": 143
              }
            },
            "attributes": [],
            "span": {
              "start": 127,
              "end": 143
            }
          }
        ]
      },
      "span": {
        "start": 121,
        "end": 144
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "G",
              "span": {
                "start": 151,
                "end": 152
              }
            },
            "value": {
              "kind": {
                "CallableCreate": {
                  "kind": {
                    "StaticMethod": {
                      "class": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "Foo"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 155,
                              "end": 158
                            }
                          }
                        },
                        "span": {
                          "start": 155,
                          "end": 158
                        }
                      },
                      "method": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 161,
                              "end": 168
                            }
                          }
                        },
                        "span": {
                          "start": 161,
                          "end": 168
                        }
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 155,
                "end": 174
              }
            },
            "attributes": [],
            "span": {
              "start": 151,
              "end": 174
            }
          }
        ]
      },
      "span": {
        "start": 145,
        "end": 175
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 175
  }
}
