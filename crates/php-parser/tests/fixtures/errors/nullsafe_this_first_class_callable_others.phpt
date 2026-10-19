===source===
<?php
$a = $x?->foo(...);
$b = $this?->a?->b(...);
$c = $THIS?->foo(...);
$d = $x?->a->b(...);
$e = $this?->foo(...)?->bar(...);
===errors >=8.1===
Cannot combine nullsafe operator with Closure creation
Cannot combine nullsafe operator with Closure creation
Cannot combine nullsafe operator with Closure creation
Cannot combine nullsafe operator with Closure creation
Cannot combine nullsafe operator with Closure creation
===php_error===
PHP Fatal error:  Cannot combine nullsafe operator with Closure creation in Standard input code on line 2
===ast >=8.1===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "NullsafeMethod": {
                        "object": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 11,
                            "end": 13
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "foo"
                          },
                          "span": {
                            "start": 16,
                            "end": 19
                          }
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 26,
                  "end": 28
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "NullsafeMethod": {
                        "object": {
                          "kind": {
                            "NullsafePropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 31,
                                  "end": 36
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "a"
                                },
                                "span": {
                                  "start": 39,
                                  "end": 40
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 31,
                            "end": 40
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "b"
                          },
                          "span": {
                            "start": 43,
                            "end": 44
                          }
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 31,
                  "end": 49
                }
              }
            }
          },
          "span": {
            "start": 26,
            "end": 49
          }
        }
      },
      "span": {
        "start": 26,
        "end": 50
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 51,
                  "end": 53
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "NullsafeMethod": {
                        "object": {
                          "kind": {
                            "Variable": "THIS"
                          },
                          "span": {
                            "start": 56,
                            "end": 61
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "foo"
                          },
                          "span": {
                            "start": 64,
                            "end": 67
                          }
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 56,
                  "end": 72
                }
              }
            }
          },
          "span": {
            "start": 51,
            "end": 72
          }
        }
      },
      "span": {
        "start": 51,
        "end": 73
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 74,
                  "end": 76
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "Method": {
                        "object": {
                          "kind": {
                            "NullsafePropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "x"
                                },
                                "span": {
                                  "start": 79,
                                  "end": 81
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "a"
                                },
                                "span": {
                                  "start": 84,
                                  "end": 85
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 79,
                            "end": 85
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "b"
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
                  "start": 79,
                  "end": 93
                }
              }
            }
          },
          "span": {
            "start": 74,
            "end": 93
          }
        }
      },
      "span": {
        "start": 74,
        "end": 94
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "e"
                },
                "span": {
                  "start": 95,
                  "end": 97
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "NullsafeMethod": {
                        "object": {
                          "kind": {
                            "CallableCreate": {
                              "kind": {
                                "NullsafeMethod": {
                                  "object": {
                                    "kind": {
                                      "Variable": "this"
                                    },
                                    "span": {
                                      "start": 100,
                                      "end": 105
                                    }
                                  },
                                  "method": {
                                    "kind": {
                                      "Identifier": "foo"
                                    },
                                    "span": {
                                      "start": 108,
                                      "end": 111
                                    }
                                  }
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 100,
                            "end": 116
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "bar"
                          },
                          "span": {
                            "start": 119,
                            "end": 122
                          }
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 100,
                  "end": 127
                }
              }
            }
          },
          "span": {
            "start": 95,
            "end": 127
          }
        }
      },
      "span": {
        "start": 95,
        "end": 128
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 128
  }
}
