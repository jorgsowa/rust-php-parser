===source===
<?php
if (true) {
    __halt_compiler();
}
===errors===
__halt_compiler() can only be used at the outermost scope
unclosed ''}'' opened at Span { start: 16, end: 17 }
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 10,
              "end": 14
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "HaltCompiler": "}"
                  },
                  "span": {
                    "start": 22,
                    "end": 42
                  }
                }
              ]
            },
            "span": {
              "start": 16,
              "end": 42
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}
===php_error===
PHP Fatal error:  __HALT_COMPILER() can only be used from the outermost scope in Standard input code on line 3
