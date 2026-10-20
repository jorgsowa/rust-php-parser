===source===
<?php

#[DelayedTargetValidation]
#[Deprecated] // Does nothing here
class DemoClass {
	#[DelayedTargetValidation]
	#[Deprecated] // Does nothing here
	public $val;

	public string $hooked {
		#[DelayedTargetValidation]
		#[Deprecated] // Does something here
		get => $this->hooked;
		#[DelayedTargetValidation]
		#[Deprecated] // Does something here
		set => $value;
	}

	#[DelayedTargetValidation]
	#[Deprecated] // Does something here
	public const CLASS_CONST = 'FOO';

	public function __construct(
		#[DelayedTargetValidation]
		#[Deprecated] // Does nothing here
		$str
	) {
		echo "Got: $str\n";
		$this->val = $str;
	}

	#[DelayedTargetValidation]
	#[Deprecated] // Does something here
	public function printVal() {
		echo 'Value is: ' . $this->val . "\n";
		return 123;
	}
}

#[DelayedTargetValidation]
#[Deprecated] // Does something here
trait DeprecatedTrait {}

class WithDeprecatedTrait {
	use DeprecatedTrait;
}

#[DelayedTargetValidation]
#[Deprecated] // Does something here
function demoFn() {
	echo __FUNCTION__ . "\n";
	return 456;
}

#[DelayedTargetValidation]
#[Deprecated] // Does something here
const GLOBAL_CONST = 'BAR';
===php_error <=8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 10
===php_error 8.4===
PHP Parse error:  syntax error, unexpected token "const" in Standard input code on line 57
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "DemoClass",
            "span": {
              "start": 75,
              "end": 84
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
                      "start": 159,
                      "end": 163
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
                          "start": 90,
                          "end": 113
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 90,
                        "end": 113
                      }
                    },
                    {
                      "name": {
                        "parts": [
                          "Deprecated"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 118,
                          "end": 128
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 118,
                        "end": 128
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 88,
                "end": 163
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "hooked",
                    "span": {
                      "start": 181,
                      "end": 188
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
                          "start": 174,
                          "end": 180
                        }
                      }
                    },
                    "span": {
                      "start": 174,
                      "end": 180
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
                                  "start": 268,
                                  "end": 273
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "hooked"
                                },
                                "span": {
                                  "start": 275,
                                  "end": 281
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 268,
                            "end": 281
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
                              "start": 195,
                              "end": 218
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 195,
                            "end": 218
                          }
                        },
                        {
                          "name": {
                            "parts": [
                              "Deprecated"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 224,
                              "end": 234
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 224,
                            "end": 234
                          }
                        }
                      ],
                      "span": {
                        "start": 193,
                        "end": 282
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
                            "start": 360,
                            "end": 366
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
                              "start": 287,
                              "end": 310
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 287,
                            "end": 310
                          }
                        },
                        {
                          "name": {
                            "parts": [
                              "Deprecated"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 316,
                              "end": 326
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 316,
                            "end": 326
                          }
                        }
                      ],
                      "span": {
                        "start": 285,
                        "end": 367
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 167,
                "end": 370
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "CLASS_CONST",
                    "span": {
                      "start": 452,
                      "end": 463
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
                      "start": 466,
                      "end": 471
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
                          "start": 375,
                          "end": 398
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 375,
                        "end": 398
                      }
                    },
                    {
                      "name": {
                        "parts": [
                          "Deprecated"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 403,
                          "end": 413
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 403,
                        "end": 413
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 373,
                "end": 472
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 491,
                      "end": 502
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
                          "start": 572,
                          "end": 576
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
                              "start": 508,
                              "end": 531
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 508,
                            "end": 531
                          }
                        },
                        {
                          "name": {
                            "parts": [
                              "Deprecated"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 537,
                              "end": 547
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 537,
                            "end": 547
                          }
                        }
                      ],
                      "span": {
                        "start": 506,
                        "end": 576
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
                                      "start": 595,
                                      "end": 599
                                    }
                                  }
                                },
                                {
                                  "Literal": "\n"
                                }
                              ]
                            },
                            "span": {
                              "start": 589,
                              "end": 602
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 584,
                        "end": 603
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
                                        "start": 606,
                                        "end": 611
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "val"
                                      },
                                      "span": {
                                        "start": 613,
                                        "end": 616
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 606,
                                  "end": 616
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "str"
                                },
                                "span": {
                                  "start": 619,
                                  "end": 623
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 606,
                            "end": 623
                          }
                        }
                      },
                      "span": {
                        "start": 606,
                        "end": 624
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 475,
                "end": 627
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "printVal",
                    "span": {
                      "start": 712,
                      "end": 720
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
                                          "start": 732,
                                          "end": 744
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
                                                "start": 747,
                                                "end": 752
                                              }
                                            },
                                            "property": {
                                              "kind": {
                                                "Identifier": "val"
                                              },
                                              "span": {
                                                "start": 754,
                                                "end": 757
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 747,
                                          "end": 757
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 732,
                                    "end": 757
                                  }
                                },
                                "op": "Concat",
                                "right": {
                                  "kind": {
                                    "String": "\n"
                                  },
                                  "span": {
                                    "start": 760,
                                    "end": 764
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 732,
                              "end": 764
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 727,
                        "end": 765
                      }
                    },
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 123
                          },
                          "span": {
                            "start": 775,
                            "end": 778
                          }
                        }
                      },
                      "span": {
                        "start": 768,
                        "end": 779
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
                          "start": 632,
                          "end": 655
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 632,
                        "end": 655
                      }
                    },
                    {
                      "name": {
                        "parts": [
                          "Deprecated"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 660,
                          "end": 670
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 660,
                        "end": 670
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 630,
                "end": 782
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
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 36,
                  "end": 46
                }
              },
              "args": [],
              "span": {
                "start": 36,
                "end": 46
              }
            }
          ]
        }
      },
      "span": {
        "start": 69,
        "end": 784
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "DeprecatedTrait",
            "span": {
              "start": 856,
              "end": 871
            }
          },
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "DelayedTargetValidation"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 788,
                  "end": 811
                }
              },
              "args": [],
              "span": {
                "start": 788,
                "end": 811
              }
            },
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 815,
                  "end": 825
                }
              },
              "args": [],
              "span": {
                "start": 815,
                "end": 825
              }
            }
          ]
        }
      },
      "span": {
        "start": 850,
        "end": 874
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "WithDeprecatedTrait",
            "span": {
              "start": 882,
              "end": 901
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
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "DeprecatedTrait"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 909,
                        "end": 924
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 905,
                "end": 925
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 876,
        "end": 927
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "demoFn",
            "span": {
              "start": 1002,
              "end": 1008
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
                            "start": 1019,
                            "end": 1031
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "String": "\n"
                          },
                          "span": {
                            "start": 1034,
                            "end": 1038
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 1019,
                      "end": 1038
                    }
                  }
                ]
              },
              "span": {
                "start": 1014,
                "end": 1039
              }
            },
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Int": 456
                  },
                  "span": {
                    "start": 1048,
                    "end": 1051
                  }
                }
              },
              "span": {
                "start": 1041,
                "end": 1052
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
                  "start": 931,
                  "end": 954
                }
              },
              "args": [],
              "span": {
                "start": 931,
                "end": 954
              }
            },
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 958,
                  "end": 968
                }
              },
              "args": [],
              "span": {
                "start": 958,
                "end": 968
              }
            }
          ]
        }
      },
      "span": {
        "start": 993,
        "end": 1054
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "GLOBAL_CONST",
              "span": {
                "start": 1126,
                "end": 1138
              }
            },
            "value": {
              "kind": {
                "String": "BAR"
              },
              "span": {
                "start": 1141,
                "end": 1146
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
                    "start": 1058,
                    "end": 1081
                  }
                },
                "args": [],
                "span": {
                  "start": 1058,
                  "end": 1081
                }
              },
              {
                "name": {
                  "parts": [
                    "Deprecated"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 1085,
                    "end": 1095
                  }
                },
                "args": [],
                "span": {
                  "start": 1085,
                  "end": 1095
                }
              }
            ],
            "span": {
              "start": 1126,
              "end": 1146
            }
          }
        ]
      },
      "span": {
        "start": 1120,
        "end": 1147
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 1147
  }
}
