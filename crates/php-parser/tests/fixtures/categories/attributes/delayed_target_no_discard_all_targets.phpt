===source===
<?php

#[DelayedTargetValidation]
#[NoDiscard] // Does nothing here
class DemoClass {
	#[DelayedTargetValidation]
	#[NoDiscard] // Does nothing here
	public $val;

	public string $hooked {
		#[DelayedTargetValidation]
		#[NoDiscard] // Does nothing here
		get => $this->hooked;
		#[DelayedTargetValidation]
		#[NoDiscard] // Does nothing here
		set => $value;
	}

	#[DelayedTargetValidation]
	#[NoDiscard] // Does nothing here
	public const CLASS_CONST = 'FOO';

	public function __construct(
		#[DelayedTargetValidation]
		#[NoDiscard] // Does nothing here
		$str
	) {
		echo "Got: $str\n";
		$this->val = $str;
	}

	#[DelayedTargetValidation]
	#[NoDiscard] // Does something here
	public function printVal() {
		echo 'Value is: ' . $this->val . "\n";
		return 123;
	}
}

#[DelayedTargetValidation]
#[NoDiscard] // Does something here
function demoFn() {
	echo __FUNCTION__ . "\n";
	return 456;
}

#[DelayedTargetValidation]
#[NoDiscard] // Does nothing here
const GLOBAL_CONST = 'BAR';
===errors <=7.4===
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
'attributes on constants' requires PHP 8.5 or higher
===errors 8.0-8.3===
'property hooks' requires PHP 8.4 or higher
'attributes on constants' requires PHP 8.5 or higher
===errors 8.4===
'attributes on constants' requires PHP 8.5 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 10
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 10
===php_error 8.4===
PHP Parse error:  syntax error, unexpected token "const" in Standard input code on line 49
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "DemoClass",
            "span": {
              "start": 74,
              "end": 83
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
                "Property": {
                  "name": {
                    "name": "val",
                    "span": {
                      "start": 157,
                      "end": 161
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "DelayedTargetValidation"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 89,
                          "end": 112
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 89,
                        "end": 112
                      }
                    },
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 117,
                          "end": 126
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 117,
                        "end": 126
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 87,
                "end": 161
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "hooked",
                    "span": {
                      "start": 179,
                      "end": 186
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 172,
                          "end": 178
                        }
                      }
                    },
                    "span": {
                      "start": 172,
                      "end": 178
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 263,
                                  "end": 268
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "hooked"
                                },
                                "span": {
                                  "start": 270,
                                  "end": 276
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 263,
                            "end": 276
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "DelayedTargetValidation"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 193,
                              "end": 216
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 193,
                            "end": 216
                          }
                        },
                        {
                          "name": {
                            "parts": [
                              "NoDiscard"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 222,
                              "end": 231
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 222,
                            "end": 231
                          }
                        }
                      ],
                      "span": {
                        "start": 191,
                        "end": 277
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Variable": "value"
                          },
                          "span": {
                            "start": 352,
                            "end": 358
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "DelayedTargetValidation"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 282,
                              "end": 305
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 282,
                            "end": 305
                          }
                        },
                        {
                          "name": {
                            "parts": [
                              "NoDiscard"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 311,
                              "end": 320
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 311,
                            "end": 320
                          }
                        }
                      ],
                      "span": {
                        "start": 280,
                        "end": 359
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 165,
                "end": 362
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "CLASS_CONST",
                    "span": {
                      "start": 441,
                      "end": 452
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "value": {
                    "kind": {
                      "String": "FOO"
                    },
                    "span": {
                      "start": 455,
                      "end": 460
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "DelayedTargetValidation"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 367,
                          "end": 390
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 367,
                        "end": 390
                      }
                    },
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 395,
                          "end": 404
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 395,
                        "end": 404
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 365,
                "end": 461
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 480,
                      "end": 491
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "str",
                        "span": {
                          "start": 560,
                          "end": 564
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "DelayedTargetValidation"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 497,
                              "end": 520
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 497,
                            "end": 520
                          }
                        },
                        {
                          "name": {
                            "parts": [
                              "NoDiscard"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 526,
                              "end": 535
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 526,
                            "end": 535
                          }
                        }
                      ],
                      "span": {
                        "start": 495,
                        "end": 564
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "InterpolatedString": [
                                {
                                  "Literal": "Got: "
                                },
                                {
                                  "Expr": {
                                    "kind": {
                                      "Variable": "str"
                                    },
                                    "span": {
                                      "start": 583,
                                      "end": 587
                                    }
                                  }
                                },
                                {
                                  "Literal": "\n"
                                }
                              ]
                            },
                            "span": {
                              "start": 577,
                              "end": 590
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 572,
                        "end": 591
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "PropertyAccess": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 594,
                                        "end": 599
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "val"
                                      },
                                      "span": {
                                        "start": 601,
                                        "end": 604
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 594,
                                  "end": 604
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "str"
                                },
                                "span": {
                                  "start": 607,
                                  "end": 611
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 594,
                            "end": 611
                          }
                        }
                      },
                      "span": {
                        "start": 594,
                        "end": 612
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 464,
                "end": 615
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "printVal",
                    "span": {
                      "start": 699,
                      "end": 707
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Binary": {
                                      "left": {
                                        "kind": {
                                          "String": "Value is: "
                                        },
                                        "span": {
                                          "start": 719,
                                          "end": 731
                                        }
                                      },
                                      "op": "Concat",
                                      "right": {
                                        "kind": {
                                          "PropertyAccess": {
                                            "object": {
                                              "kind": {
                                                "Variable": "this"
                                              },
                                              "span": {
                                                "start": 734,
                                                "end": 739
                                              }
                                            },
                                            "property": {
                                              "kind": {
                                                "Identifier": "val"
                                              },
                                              "span": {
                                                "start": 741,
                                                "end": 744
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 734,
                                          "end": 744
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 719,
                                    "end": 744
                                  }
                                },
                                "op": "Concat",
                                "right": {
                                  "kind": {
                                    "String": "\n"
                                  },
                                  "span": {
                                    "start": 747,
                                    "end": 751
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 719,
                              "end": 751
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 714,
                        "end": 752
                      }
                    },
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 123
                          },
                          "span": {
                            "start": 762,
                            "end": 765
                          }
                        }
                      },
                      "span": {
                        "start": 755,
                        "end": 766
                      }
                    }
                  ],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "DelayedTargetValidation"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 620,
                          "end": 643
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 620,
                        "end": 643
                      }
                    },
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 648,
                          "end": 657
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 648,
                        "end": 657
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 618,
                "end": 769
              }
            }
          ],
          "attributes": [
            {
              "name": {
                "parts": [
                  "DelayedTargetValidation"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 9,
                  "end": 32
                }
              },
              "args": [],
              "span": {
                "start": 9,
                "end": 32
              }
            },
            {
              "name": {
                "parts": [
                  "NoDiscard"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 36,
                  "end": 45
                }
              },
              "args": [],
              "span": {
                "start": 36,
                "end": 45
              }
            }
          ]
        }
      },
      "span": {
        "start": 68,
        "end": 771
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "demoFn",
            "span": {
              "start": 845,
              "end": 851
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Echo": [
                  {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "MagicConst": "Function"
                          },
                          "span": {
                            "start": 862,
                            "end": 874
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "String": "\n"
                          },
                          "span": {
                            "start": 877,
                            "end": 881
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 862,
                      "end": 881
                    }
                  }
                ]
              },
              "span": {
                "start": 857,
                "end": 882
              }
            },
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Int": 456
                  },
                  "span": {
                    "start": 891,
                    "end": 894
                  }
                }
              },
              "span": {
                "start": 884,
                "end": 895
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "DelayedTargetValidation"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 775,
                  "end": 798
                }
              },
              "args": [],
              "span": {
                "start": 775,
                "end": 798
              }
            },
            {
              "name": {
                "parts": [
                  "NoDiscard"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 802,
                  "end": 811
                }
              },
              "args": [],
              "span": {
                "start": 802,
                "end": 811
              }
            }
          ]
        }
      },
      "span": {
        "start": 836,
        "end": 897
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "GLOBAL_CONST",
              "span": {
                "start": 966,
                "end": 978
              }
            },
            "value": {
              "kind": {
                "String": "BAR"
              },
              "span": {
                "start": 981,
                "end": 986
              }
            },
            "attributes": [
              {
                "name": {
                  "parts": [
                    "DelayedTargetValidation"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 901,
                    "end": 924
                  }
                },
                "args": [],
                "span": {
                  "start": 901,
                  "end": 924
                }
              },
              {
                "name": {
                  "parts": [
                    "NoDiscard"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 928,
                    "end": 937
                  }
                },
                "args": [],
                "span": {
                  "start": 928,
                  "end": 937
                }
              }
            ],
            "span": {
              "start": 966,
              "end": 986
            }
          }
        ]
      },
      "span": {
        "start": 960,
        "end": 987
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 987
  }
}
