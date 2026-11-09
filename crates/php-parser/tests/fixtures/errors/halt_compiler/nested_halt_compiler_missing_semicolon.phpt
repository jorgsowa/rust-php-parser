===source===
<?php
if (true) {
    __halt_compiler()
}
===errors===
__HALT_COMPILER() can only be used from the outermost scope
expected ';' or '?>' after __halt_compiler()
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}', expecting ';' in Standard input code on line 4
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "}", expecting ";" in Standard input code on line 4
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
                    "HaltCompiler": ""
                  },
                  "span": {
                    "start": 22,
                    "end": 39
                  }
                }
              ]
            },
            "span": {
              "start": 16,
              "end": 41
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
