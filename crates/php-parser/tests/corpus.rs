mod common;
use common::{assert_no_errors, to_json};

fn parse_php(source: &'static str) -> php_rs_parser::ParseResult<'static, 'static> {
    // Leak arena and source for test simplicity — process exits after test run anyway
    let arena: &'static bumpalo::Bump = Box::leak(Box::new(bumpalo::Bump::new()));
    php_rs_parser::parse(arena, source)
}

macro_rules! fixture_test {
    ($name:ident, $file:expr) => {
        #[test]
        fn $name() {
            let source = include_str!(concat!("fixtures/", $file));
            let result = parse_php(source);
            assert_no_errors(&result);
            insta::assert_snapshot!(to_json(&result.program));
        }
    };
    ($name:ident, $file:expr, errors) => {
        #[test]
        fn $name() {
            let source = include_str!(concat!("fixtures/", $file));
            let result = parse_php(source);
            assert!(
                !result.errors.is_empty(),
                "expected parse errors but found none"
            );
            insta::assert_snapshot!(to_json(&result.program));
        }
    };
}

// =============================================================================
// PHP-Parser corpus fixtures (error handling, expr, scalar, stmt)
// =============================================================================

// error handling
fixture_test!(
    errorhandling_eoferror_1,
    "corpus/errorHandling/eofError_1.php",
    errors
);
fixture_test!(
    errorhandling_eoferror_2,
    "corpus/errorHandling/eofError_2.php",
    errors
);
fixture_test!(
    errorhandling_lexererrors_1,
    "corpus/errorHandling/lexerErrors_1.php"
);
fixture_test!(
    errorhandling_lexererrors_5,
    "corpus/errorHandling/lexerErrors_5.php",
    errors
);
fixture_test!(
    errorhandling_recovery_1,
    "corpus/errorHandling/recovery_1.php",
    errors
);
fixture_test!(
    errorhandling_recovery_2,
    "corpus/errorHandling/recovery_2.php",
    errors
);
fixture_test!(
    errorhandling_recovery_3,
    "corpus/errorHandling/recovery_3.php",
    errors
);
fixture_test!(
    errorhandling_recovery_4,
    "corpus/errorHandling/recovery_4.php",
    errors
);
fixture_test!(
    errorhandling_recovery_5,
    "corpus/errorHandling/recovery_5.php",
    errors
);
fixture_test!(
    errorhandling_recovery_6,
    "corpus/errorHandling/recovery_6.php",
    errors
);
fixture_test!(
    errorhandling_recovery_7,
    "corpus/errorHandling/recovery_7.php",
    errors
);
fixture_test!(
    errorhandling_recovery_8,
    "corpus/errorHandling/recovery_8.php",
    errors
);
fixture_test!(
    errorhandling_recovery_9,
    "corpus/errorHandling/recovery_9.php",
    errors
);
fixture_test!(
    errorhandling_recovery_10,
    "corpus/errorHandling/recovery_10.php",
    errors
);
fixture_test!(
    errorhandling_recovery_11,
    "corpus/errorHandling/recovery_11.php",
    errors
);
fixture_test!(
    errorhandling_recovery_12,
    "corpus/errorHandling/recovery_12.php",
    errors
);
fixture_test!(
    errorhandling_recovery_13,
    "corpus/errorHandling/recovery_13.php",
    errors
);
fixture_test!(
    errorhandling_recovery_14,
    "corpus/errorHandling/recovery_14.php",
    errors
);
fixture_test!(
    errorhandling_recovery_15,
    "corpus/errorHandling/recovery_15.php",
    errors
);
fixture_test!(
    errorhandling_recovery_16,
    "corpus/errorHandling/recovery_16.php",
    errors
);
fixture_test!(
    errorhandling_recovery_17,
    "corpus/errorHandling/recovery_17.php",
    errors
);
fixture_test!(
    errorhandling_recovery_18,
    "corpus/errorHandling/recovery_18.php"
);
fixture_test!(
    errorhandling_recovery_19,
    "corpus/errorHandling/recovery_19.php",
    errors
);
fixture_test!(
    errorhandling_recovery_20,
    "corpus/errorHandling/recovery_20.php",
    errors
);
fixture_test!(
    errorhandling_recovery_21,
    "corpus/errorHandling/recovery_21.php",
    errors
);
fixture_test!(
    errorhandling_recovery_22,
    "corpus/errorHandling/recovery_22.php",
    errors
);
fixture_test!(
    errorhandling_recovery_23,
    "corpus/errorHandling/recovery_23.php",
    errors
);
fixture_test!(
    errorhandling_recovery_24,
    "corpus/errorHandling/recovery_24.php",
    errors
);
fixture_test!(
    errorhandling_recovery_25,
    "corpus/errorHandling/recovery_25.php",
    errors
);
fixture_test!(
    errorhandling_recovery_26,
    "corpus/errorHandling/recovery_26.php",
    errors
);

// expr
fixture_test!(
    expr_alternative_array_syntax_1,
    "corpus/expr/alternative_array_syntax_1.php"
);
fixture_test!(
    expr_alternative_array_syntax_2,
    "corpus/expr/alternative_array_syntax_2.php"
);
fixture_test!(expr_arraydef, "corpus/expr/arrayDef.php");
fixture_test!(expr_arraydestructuring, "corpus/expr/arrayDestructuring.php");
fixture_test!(
    expr_arrayemptyelemens,
    "corpus/expr/arrayEmptyElemens.php",
    errors
);
fixture_test!(expr_arrayspread, "corpus/expr/arraySpread.php");
fixture_test!(expr_arrow_function, "corpus/expr/arrow_function.php");
fixture_test!(expr_assign, "corpus/expr/assign.php");
fixture_test!(expr_assignnewbyref_1, "corpus/expr/assignNewByRef_1.php");
fixture_test!(expr_assignnewbyref_2, "corpus/expr/assignNewByRef_2.php");
fixture_test!(expr_cast, "corpus/expr/cast.php", errors);
fixture_test!(expr_clone, "corpus/expr/clone.php");
fixture_test!(expr_closure, "corpus/expr/closure.php");
fixture_test!(
    expr_closure_use_trailing_comma,
    "corpus/expr/closure_use_trailing_comma.php"
);
fixture_test!(expr_comparison, "corpus/expr/comparison.php");
fixture_test!(expr_concatprecedence_1, "corpus/expr/concatPrecedence_1.php");
fixture_test!(expr_concatprecedence_2, "corpus/expr/concatPrecedence_2.php");
fixture_test!(expr_constant_expr, "corpus/expr/constant_expr.php");
fixture_test!(expr_dynamicclassconst, "corpus/expr/dynamicClassConst.php");
fixture_test!(expr_errorsuppress, "corpus/expr/errorSuppress.php");
fixture_test!(expr_exit, "corpus/expr/exit.php");
fixture_test!(expr_exprinisset, "corpus/expr/exprInIsset.php");
fixture_test!(expr_exprinlist, "corpus/expr/exprInList.php");
fixture_test!(expr_fetchandcall_args, "corpus/expr/fetchAndCall/args.php");
fixture_test!(
    expr_fetchandcall_constfetch,
    "corpus/expr/fetchAndCall/constFetch.php"
);
fixture_test!(
    expr_fetchandcall_constantderef,
    "corpus/expr/fetchAndCall/constantDeref.php"
);
fixture_test!(
    expr_fetchandcall_funccall,
    "corpus/expr/fetchAndCall/funcCall.php"
);
fixture_test!(
    expr_fetchandcall_namedargs,
    "corpus/expr/fetchAndCall/namedArgs.php"
);
fixture_test!(
    expr_fetchandcall_newderef,
    "corpus/expr/fetchAndCall/newDeref.php"
);
fixture_test!(
    expr_fetchandcall_objectaccess,
    "corpus/expr/fetchAndCall/objectAccess.php"
);
fixture_test!(
    expr_fetchandcall_simplearrayaccess,
    "corpus/expr/fetchAndCall/simpleArrayAccess.php"
);
fixture_test!(
    expr_fetchandcall_staticcall,
    "corpus/expr/fetchAndCall/staticCall.php"
);
fixture_test!(
    expr_fetchandcall_staticpropertyfetch,
    "corpus/expr/fetchAndCall/staticPropertyFetch.php"
);
fixture_test!(
    expr_firstclasscallables,
    "corpus/expr/firstClassCallables.php"
);
fixture_test!(expr_includeandeval, "corpus/expr/includeAndEval.php");
fixture_test!(expr_issetandempty, "corpus/expr/issetAndEmpty.php");
fixture_test!(
    expr_keywordsinnamespacedname,
    "corpus/expr/keywordsInNamespacedName.php"
);
fixture_test!(expr_listreferences, "corpus/expr/listReferences.php");
fixture_test!(expr_listwithkeys, "corpus/expr/listWithKeys.php");
fixture_test!(expr_logic, "corpus/expr/logic.php");
fixture_test!(expr_match_1, "corpus/expr/match_1.php");
fixture_test!(expr_match_2, "corpus/expr/match_2.php");
fixture_test!(expr_match_3, "corpus/expr/match_3.php");
fixture_test!(expr_match_4, "corpus/expr/match_4.php");
fixture_test!(expr_match_5, "corpus/expr/match_5.php");
fixture_test!(expr_math, "corpus/expr/math.php");
fixture_test!(expr_new, "corpus/expr/new.php");
fixture_test!(expr_newderef, "corpus/expr/newDeref.php");
fixture_test!(
    expr_newwithoutclass,
    "corpus/expr/newWithoutClass.php",
    errors
);
fixture_test!(expr_nullsafe, "corpus/expr/nullsafe.php");
fixture_test!(expr_pipe, "corpus/expr/pipe.php");
fixture_test!(expr_print, "corpus/expr/print.php");
fixture_test!(expr_shellexec, "corpus/expr/shellExec.php");
fixture_test!(expr_ternaryandcoalesce, "corpus/expr/ternaryAndCoalesce.php");
fixture_test!(expr_throw, "corpus/expr/throw.php");
fixture_test!(expr_trailingcommas, "corpus/expr/trailingCommas.php");
fixture_test!(expr_uvs_constderef, "corpus/expr/uvs/constDeref.php");
fixture_test!(
    expr_uvs_globalnonsimplevarerror,
    "corpus/expr/uvs/globalNonSimpleVarError.php",
    errors
);
fixture_test!(expr_uvs_indirectcall, "corpus/expr/uvs/indirectCall.php");
fixture_test!(expr_uvs_isset, "corpus/expr/uvs/isset.php");
fixture_test!(expr_uvs_misc, "corpus/expr/uvs/misc.php");
fixture_test!(expr_uvs_new, "corpus/expr/uvs/new.php");
fixture_test!(
    expr_uvs_newinstanceofexpr,
    "corpus/expr/uvs/newInstanceofExpr.php"
);
fixture_test!(expr_uvs_staticproperty, "corpus/expr/uvs/staticProperty.php");
fixture_test!(expr_varvarpos, "corpus/expr/varVarPos.php");
fixture_test!(expr_variable, "corpus/expr/variable.php");

// misc
fixture_test!(blockcomments, "corpus/blockComments.php");
fixture_test!(commentatendofclass, "corpus/commentAtEndOfClass.php");
fixture_test!(comments_1, "corpus/comments_1.php");
fixture_test!(comments_2, "corpus/comments_2.php");
fixture_test!(comments_3, "corpus/comments_3.php");
fixture_test!(emptyfile, "corpus/emptyFile.php");
fixture_test!(formattingattributes, "corpus/formattingAttributes.php");
fixture_test!(noppositions_1, "corpus/nopPositions_1.php");
fixture_test!(noppositions_2, "corpus/nopPositions_2.php");
fixture_test!(semireserved, "corpus/semiReserved.php");

// scalar
fixture_test!(scalar_constantstring, "corpus/scalar/constantString.php");
fixture_test!(scalar_docstring, "corpus/scalar/docString.php");
fixture_test!(scalar_encapsedstring, "corpus/scalar/encapsedString.php");
fixture_test!(scalar_explicitoctal, "corpus/scalar/explicitOctal.php");
fixture_test!(scalar_float, "corpus/scalar/float.php");
fixture_test!(scalar_invalidoctal_1, "corpus/scalar/invalidOctal_1.php");
fixture_test!(scalar_invalidoctal_2, "corpus/scalar/invalidOctal_2.php");
fixture_test!(scalar_magicconst, "corpus/scalar/magicConst.php");
fixture_test!(
    scalar_numberseparators,
    "corpus/scalar/numberSeparators.php",
    errors
);
fixture_test!(scalar_unicodeescape_1, "corpus/scalar/unicodeEscape_1.php");
fixture_test!(scalar_unicodeescape_2, "corpus/scalar/unicodeEscape_2.php");
fixture_test!(scalar_unicodeescape_3, "corpus/scalar/unicodeEscape_3.php");

// stmt
fixture_test!(stmt_attributes, "corpus/stmt/attributes.php");
fixture_test!(stmt_blocklessstatement, "corpus/stmt/blocklessStatement.php");
fixture_test!(stmt_class_abstract, "corpus/stmt/class/abstract.php");
fixture_test!(stmt_class_anonymous, "corpus/stmt/class/anonymous.php");
fixture_test!(
    stmt_class_asymmetric_visibility_1,
    "corpus/stmt/class/asymmetric_visibility_1.php"
);
fixture_test!(
    stmt_class_asymmetric_visibility_2,
    "corpus/stmt/class/asymmetric_visibility_2.php"
);
fixture_test!(
    stmt_class_class_position_1,
    "corpus/stmt/class/class_position_1.php"
);
fixture_test!(
    stmt_class_class_position_2,
    "corpus/stmt/class/class_position_2.php"
);
fixture_test!(
    stmt_class_class_position_3,
    "corpus/stmt/class/class_position_3.php"
);
fixture_test!(stmt_class_conditional, "corpus/stmt/class/conditional.php");
fixture_test!(
    stmt_class_constmodifiererrors_1,
    "corpus/stmt/class/constModifierErrors_1.php",
    errors
);
fixture_test!(
    stmt_class_constmodifiererrors_2,
    "corpus/stmt/class/constModifierErrors_2.php",
    errors
);
fixture_test!(
    stmt_class_constmodifiererrors_3,
    "corpus/stmt/class/constModifierErrors_3.php",
    errors
);
fixture_test!(
    stmt_class_constmodifiererrors_4,
    "corpus/stmt/class/constModifierErrors_4.php",
    errors
);
fixture_test!(
    stmt_class_constmodifiers,
    "corpus/stmt/class/constModifiers.php"
);
fixture_test!(stmt_class_enum, "corpus/stmt/class/enum.php", errors);
fixture_test!(
    stmt_class_enum_with_string,
    "corpus/stmt/class/enum_with_string.php"
);
fixture_test!(stmt_class_final, "corpus/stmt/class/final.php");
fixture_test!(
    stmt_class_implicitpublic,
    "corpus/stmt/class/implicitPublic.php"
);
fixture_test!(stmt_class_interface, "corpus/stmt/class/interface.php");
fixture_test!(
    stmt_class_modifier_error_1,
    "corpus/stmt/class/modifier_error_1.php",
    errors
);
fixture_test!(
    stmt_class_modifier_error_2,
    "corpus/stmt/class/modifier_error_2.php",
    errors
);
fixture_test!(
    stmt_class_modifier_error_3,
    "corpus/stmt/class/modifier_error_3.php",
    errors
);
fixture_test!(
    stmt_class_modifier_error_4,
    "corpus/stmt/class/modifier_error_4.php",
    errors
);
fixture_test!(
    stmt_class_modifier_error_5,
    "corpus/stmt/class/modifier_error_5.php",
    errors
);
fixture_test!(
    stmt_class_modifier_error_6,
    "corpus/stmt/class/modifier_error_6.php",
    errors
);
fixture_test!(
    stmt_class_modifier_error_7,
    "corpus/stmt/class/modifier_error_7.php",
    errors
);
fixture_test!(
    stmt_class_modifier_error_8,
    "corpus/stmt/class/modifier_error_8.php",
    errors
);
fixture_test!(stmt_class_name_1, "corpus/stmt/class/name_1.php", errors);
fixture_test!(stmt_class_name_2, "corpus/stmt/class/name_2.php", errors);
fixture_test!(stmt_class_name_3, "corpus/stmt/class/name_3.php", errors);
fixture_test!(stmt_class_name_4, "corpus/stmt/class/name_4.php", errors);
fixture_test!(stmt_class_name_5, "corpus/stmt/class/name_5.php", errors);
fixture_test!(stmt_class_name_6, "corpus/stmt/class/name_6.php", errors);
fixture_test!(stmt_class_name_7, "corpus/stmt/class/name_7.php", errors);
fixture_test!(stmt_class_name_8, "corpus/stmt/class/name_8.php", errors);
fixture_test!(stmt_class_name_9, "corpus/stmt/class/name_9.php", errors);
fixture_test!(stmt_class_name_10, "corpus/stmt/class/name_10.php", errors);
fixture_test!(stmt_class_name_11, "corpus/stmt/class/name_11.php", errors);
fixture_test!(stmt_class_name_12, "corpus/stmt/class/name_12.php", errors);
fixture_test!(stmt_class_name_13, "corpus/stmt/class/name_13.php", errors);
fixture_test!(stmt_class_name_14, "corpus/stmt/class/name_14.php", errors);
fixture_test!(stmt_class_name_15, "corpus/stmt/class/name_15.php", errors);
fixture_test!(
    stmt_class_php4style,
    "corpus/stmt/class/php4Style.php",
    errors
);
fixture_test!(
    stmt_class_propertytypes,
    "corpus/stmt/class/propertyTypes.php"
);
fixture_test!(
    stmt_class_property_hooks_1,
    "corpus/stmt/class/property_hooks_1.php"
);
fixture_test!(
    stmt_class_property_hooks_2,
    "corpus/stmt/class/property_hooks_2.php"
);
fixture_test!(
    stmt_class_property_hooks_3,
    "corpus/stmt/class/property_hooks_3.php"
);
fixture_test!(
    stmt_class_property_hooks_4,
    "corpus/stmt/class/property_hooks_4.php",
    errors
);
fixture_test!(
    stmt_class_property_hooks_5,
    "corpus/stmt/class/property_hooks_5.php",
    errors
);
fixture_test!(
    stmt_class_property_hooks_6,
    "corpus/stmt/class/property_hooks_6.php",
    errors
);
fixture_test!(
    stmt_class_property_hooks_7,
    "corpus/stmt/class/property_hooks_7.php",
    errors
);
fixture_test!(
    stmt_class_property_modifiers,
    "corpus/stmt/class/property_modifiers.php"
);
fixture_test!(
    stmt_class_property_promotion,
    "corpus/stmt/class/property_promotion.php"
);
fixture_test!(stmt_class_readonly_1, "corpus/stmt/class/readonly_1.php");
fixture_test!(stmt_class_readonly_2, "corpus/stmt/class/readonly_2.php");
fixture_test!(
    stmt_class_readonlyanonyous,
    "corpus/stmt/class/readonlyAnonyous.php"
);
fixture_test!(
    stmt_class_readonlyasclassname_1,
    "corpus/stmt/class/readonlyAsClassName_1.php",
    errors
);
fixture_test!(
    stmt_class_readonlyasclassname_2,
    "corpus/stmt/class/readonlyAsClassName_2.php",
    errors
);
fixture_test!(
    stmt_class_readonlymethod,
    "corpus/stmt/class/readonlyMethod.php"
);
fixture_test!(
    stmt_class_shortechoasidentifier,
    "corpus/stmt/class/shortEchoAsIdentifier.php",
    errors
);
fixture_test!(stmt_class_simple, "corpus/stmt/class/simple.php");
fixture_test!(
    stmt_class_staticmethod_1,
    "corpus/stmt/class/staticMethod_1.php"
);
fixture_test!(
    stmt_class_staticmethod_2,
    "corpus/stmt/class/staticMethod_2.php"
);
fixture_test!(
    stmt_class_staticmethod_3,
    "corpus/stmt/class/staticMethod_3.php"
);
fixture_test!(
    stmt_class_staticmethod_4,
    "corpus/stmt/class/staticMethod_4.php"
);
fixture_test!(
    stmt_class_staticmethod_5,
    "corpus/stmt/class/staticMethod_5.php"
);
fixture_test!(
    stmt_class_staticmethod_6,
    "corpus/stmt/class/staticMethod_6.php"
);
fixture_test!(stmt_class_statictype, "corpus/stmt/class/staticType.php");
fixture_test!(stmt_class_trait, "corpus/stmt/class/trait.php");
fixture_test!(
    stmt_class_typedconstants,
    "corpus/stmt/class/typedConstants.php"
);
fixture_test!(stmt_const, "corpus/stmt/const.php", errors);
fixture_test!(stmt_controlflow, "corpus/stmt/controlFlow.php");
fixture_test!(stmt_declare, "corpus/stmt/declare.php");
fixture_test!(stmt_echo, "corpus/stmt/echo.php");
fixture_test!(
    stmt_function_builtintypedeclarations,
    "corpus/stmt/function/builtinTypeDeclarations.php"
);
fixture_test!(stmt_function_byref, "corpus/stmt/function/byRef.php");
fixture_test!(
    stmt_function_clone_function,
    "corpus/stmt/function/clone_function.php"
);
fixture_test!(
    stmt_function_conditional,
    "corpus/stmt/function/conditional.php"
);
fixture_test!(
    stmt_function_defaultvalues,
    "corpus/stmt/function/defaultValues.php"
);
fixture_test!(
    stmt_function_disjointnormalformtypes,
    "corpus/stmt/function/disjointNormalFormTypes.php"
);
fixture_test!(
    stmt_function_exit_die_function,
    "corpus/stmt/function/exit_die_function.php"
);
fixture_test!(
    stmt_function_intersectiontypes,
    "corpus/stmt/function/intersectionTypes.php"
);
fixture_test!(stmt_function_nevertype, "corpus/stmt/function/neverType.php");
fixture_test!(
    stmt_function_nullfalsetruetypes_1,
    "corpus/stmt/function/nullFalseTrueTypes_1.php"
);
fixture_test!(
    stmt_function_nullfalsetruetypes_2,
    "corpus/stmt/function/nullFalseTrueTypes_2.php"
);
fixture_test!(
    stmt_function_nullabletypes,
    "corpus/stmt/function/nullableTypes.php"
);
fixture_test!(
    stmt_function_parameters_trailing_comma_1,
    "corpus/stmt/function/parameters_trailing_comma_1.php"
);
fixture_test!(
    stmt_function_parameters_trailing_comma_2,
    "corpus/stmt/function/parameters_trailing_comma_2.php"
);
fixture_test!(
    stmt_function_parameters_trailing_comma_3,
    "corpus/stmt/function/parameters_trailing_comma_3.php"
);
fixture_test!(
    stmt_function_readonlyfunction,
    "corpus/stmt/function/readonlyFunction.php"
);
fixture_test!(
    stmt_function_returntypes,
    "corpus/stmt/function/returnTypes.php"
);
fixture_test!(
    stmt_function_specialvars,
    "corpus/stmt/function/specialVars.php"
);
fixture_test!(
    stmt_function_typedeclarations,
    "corpus/stmt/function/typeDeclarations.php"
);
fixture_test!(
    stmt_function_typeversions_1,
    "corpus/stmt/function/typeVersions_1.php"
);
fixture_test!(
    stmt_function_typeversions_2,
    "corpus/stmt/function/typeVersions_2.php"
);
fixture_test!(
    stmt_function_typeversions_3,
    "corpus/stmt/function/typeVersions_3.php"
);
fixture_test!(
    stmt_function_typeversions_4,
    "corpus/stmt/function/typeVersions_4.php"
);
fixture_test!(
    stmt_function_typeversions_5,
    "corpus/stmt/function/typeVersions_5.php"
);
fixture_test!(
    stmt_function_typeversions_6,
    "corpus/stmt/function/typeVersions_6.php"
);
fixture_test!(
    stmt_function_uniontypes,
    "corpus/stmt/function/unionTypes.php"
);
fixture_test!(stmt_function_variadic, "corpus/stmt/function/variadic.php");
fixture_test!(
    stmt_function_variadicdefaultvalue,
    "corpus/stmt/function/variadicDefaultValue.php"
);
fixture_test!(stmt_generator_basic, "corpus/stmt/generator/basic.php");
fixture_test!(
    stmt_generator_yieldprecedence,
    "corpus/stmt/generator/yieldPrecedence.php"
);
fixture_test!(
    stmt_generator_yieldunaryprecedence,
    "corpus/stmt/generator/yieldUnaryPrecedence.php"
);
fixture_test!(stmt_haltcompiler_1, "corpus/stmt/haltCompiler_1.php");
fixture_test!(stmt_haltcompiler_2, "corpus/stmt/haltCompiler_2.php");
fixture_test!(stmt_haltcompiler_3, "corpus/stmt/haltCompiler_3.php");
fixture_test!(
    stmt_haltcompilerinvalidsyntax,
    "corpus/stmt/haltCompilerInvalidSyntax.php",
    errors
);
fixture_test!(stmt_haltcompileroffset, "corpus/stmt/haltCompilerOffset.php");
fixture_test!(
    stmt_haltcompileroutermostscope,
    "corpus/stmt/haltCompilerOutermostScope.php",
    errors
);
fixture_test!(stmt_hashbang, "corpus/stmt/hashbang.php");
fixture_test!(stmt_if, "corpus/stmt/if.php");
fixture_test!(stmt_inlinehtml, "corpus/stmt/inlineHTML.php");
fixture_test!(stmt_loop_do, "corpus/stmt/loop/do.php");
fixture_test!(stmt_loop_for, "corpus/stmt/loop/for.php");
fixture_test!(stmt_loop_foreach, "corpus/stmt/loop/foreach.php");
fixture_test!(stmt_loop_while, "corpus/stmt/loop/while.php");
fixture_test!(stmt_multicatch, "corpus/stmt/multiCatch.php");
fixture_test!(stmt_namespace_alias, "corpus/stmt/namespace/alias.php");
fixture_test!(stmt_namespace_braced, "corpus/stmt/namespace/braced.php");
fixture_test!(
    stmt_namespace_commentafternamespace,
    "corpus/stmt/namespace/commentAfterNamespace.php"
);
fixture_test!(stmt_namespace_groupuse, "corpus/stmt/namespace/groupUse.php");
fixture_test!(
    stmt_namespace_groupuseerrors_1,
    "corpus/stmt/namespace/groupUseErrors_1.php",
    errors
);
fixture_test!(
    stmt_namespace_groupuseerrors_2,
    "corpus/stmt/namespace/groupUseErrors_2.php",
    errors
);
fixture_test!(
    stmt_namespace_groupuseerrors_3,
    "corpus/stmt/namespace/groupUseErrors_3.php",
    errors
);
fixture_test!(
    stmt_namespace_groupusepositions,
    "corpus/stmt/namespace/groupUsePositions.php"
);
fixture_test!(
    stmt_namespace_groupusetrailingcomma,
    "corpus/stmt/namespace/groupUseTrailingComma.php"
);
fixture_test!(
    stmt_namespace_invalidname_1,
    "corpus/stmt/namespace/invalidName_1.php",
    errors
);
fixture_test!(
    stmt_namespace_invalidname_2,
    "corpus/stmt/namespace/invalidName_2.php",
    errors
);
fixture_test!(
    stmt_namespace_invalidname_3,
    "corpus/stmt/namespace/invalidName_3.php",
    errors
);
fixture_test!(stmt_namespace_mix_1, "corpus/stmt/namespace/mix_1.php");
fixture_test!(stmt_namespace_mix_2, "corpus/stmt/namespace/mix_2.php");
fixture_test!(stmt_namespace_name, "corpus/stmt/namespace/name.php");
fixture_test!(stmt_namespace_nested, "corpus/stmt/namespace/nested.php");
fixture_test!(
    stmt_namespace_notbraced,
    "corpus/stmt/namespace/notBraced.php"
);
fixture_test!(
    stmt_namespace_nsafterhashbang,
    "corpus/stmt/namespace/nsAfterHashbang.php"
);
fixture_test!(
    stmt_namespace_outsidestmt_1,
    "corpus/stmt/namespace/outsideStmt_1.php"
);
fixture_test!(
    stmt_namespace_outsidestmt_2,
    "corpus/stmt/namespace/outsideStmt_2.php"
);
fixture_test!(
    stmt_namespace_outsidestmtinvalid_1,
    "corpus/stmt/namespace/outsideStmtInvalid_1.php"
);
fixture_test!(
    stmt_namespace_outsidestmtinvalid_2,
    "corpus/stmt/namespace/outsideStmtInvalid_2.php"
);
fixture_test!(
    stmt_namespace_outsidestmtinvalid_3,
    "corpus/stmt/namespace/outsideStmtInvalid_3.php"
);
fixture_test!(stmt_newininitializer, "corpus/stmt/newInInitializer.php");
fixture_test!(stmt_switch, "corpus/stmt/switch.php");
fixture_test!(stmt_trycatch, "corpus/stmt/tryCatch.php");
fixture_test!(
    stmt_trycatch_without_variable,
    "corpus/stmt/tryCatch_without_variable.php"
);
fixture_test!(
    stmt_trywithoutcatch,
    "corpus/stmt/tryWithoutCatch.php",
    errors
);
fixture_test!(stmt_unset, "corpus/stmt/unset.php");
fixture_test!(stmt_voidcast, "corpus/stmt/voidCast.php");
